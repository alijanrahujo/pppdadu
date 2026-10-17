<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    /**
     * Display Online Membership applications.
     */
    public function memberships(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = WebsiteSubmission::query()
            ->where('submission_type', 'membership')
            ->latest();

        if ($status !== 'all' && in_array($status, ['new', 'approved', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $submissions = $query->paginate(20)->withQueryString();

        // If search is given, filter in memory due to encrypted payload
        if (! empty($search)) {
            $search = strtolower(trim($search));
            $all = WebsiteSubmission::query()
                ->where('submission_type', 'membership')
                ->latest()
                ->get()
                ->filter(function ($item) use ($search) {
                    $payload = $item->payload ?? [];
                    $name = strtolower($payload['full_name'] ?? '');
                    $cnic = strtolower($payload['cnic_number'] ?? '');
                    $phone = strtolower($payload['mobile_number'] ?? $payload['phone_number'] ?? '');
                    $city = strtolower($payload['city'] ?? $payload['district'] ?? '');

                    return str_contains($name, $search) || str_contains($cnic, $search) || str_contains($phone, $search) || str_contains($city, $search);
                });

            // Re-paginate filtered collection
            $page = $request->query('page', 1);
            $perPage = 20;
            $submissions = new LengthAwarePaginator(
                $all->forPage($page, $perPage),
                $all->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('admin.submissions.memberships', compact('submissions', 'status', 'search'));
    }

    /**
     * Display Suggestions, Complaints, and Contacts.
     */
    public function contacts(Request $request): View
    {
        $status = $request->query('status', 'all');
        $type = $request->query('type', 'all');
        $search = $request->query('search');

        $query = WebsiteSubmission::query()
            ->where('submission_type', 'contact')
            ->latest();

        if ($status !== 'all' && in_array($status, ['new', 'reviewed', 'resolved'], true)) {
            $query->where('status', $status);
        }

        $submissions = $query->paginate(20)->withQueryString();

        if (! empty($search) || $type !== 'all') {
            $search = strtolower(trim((string) $search));
            $all = WebsiteSubmission::query()
                ->where('submission_type', 'contact')
                ->latest()
                ->get()
                ->filter(function ($item) use ($search, $type) {
                    $payload = $item->payload ?? [];

                    if ($type !== 'all' && ($payload['contact_type'] ?? '') !== $type) {
                        return false;
                    }

                    if (! empty($search)) {
                        $name = strtolower($payload['full_name'] ?? '');
                        $cnic = strtolower($payload['cnic_number'] ?? '');
                        $email = strtolower($payload['email_address'] ?? '');
                        $message = strtolower($payload['message'] ?? '');

                        return str_contains($name, $search) || str_contains($cnic, $search) || str_contains($email, $search) || str_contains($message, $search);
                    }

                    return true;
                });

            $page = $request->query('page', 1);
            $perPage = 20;
            $submissions = new LengthAwarePaginator(
                $all->forPage($page, $perPage),
                $all->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        return view('admin.submissions.contacts', compact('submissions', 'status', 'type', 'search'));
    }

    /**
     * Update submission status.
     */
    public function updateStatus(Request $request, WebsiteSubmission $submission): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $submission->update([
            'status' => $validated['status'],
            'is_read' => true,
        ]);

        return back()->with('status', 'Submission status updated to '.ucfirst($validated['status']).'.');
    }

    /**
     * Delete submission.
     */
    public function destroy(WebsiteSubmission $submission): RedirectResponse
    {
        $type = $submission->submission_type;
        $submission->delete();

        return back()->with('status', ucfirst($type).' submission deleted successfully.');
    }
}
