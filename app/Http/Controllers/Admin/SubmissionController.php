<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Membership;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    /**
     * Display Online Membership applications directly from the Membership model.
     */
    public function memberships(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = Membership::query()->latest();

        if ($status !== 'all' && in_array($status, ['new', 'approved', 'rejected'], true)) {
            $query->where('status', $status);
        }

        if (! empty($search)) {
            $search = trim((string) $search);
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('cnic_number', 'like', "%{$search}%")
                    ->orWhere('mobile_number', 'like', "%{$search}%")
                    ->orWhere('email_address', 'like', "%{$search}%")
                    ->orWhere('tehsil_city', 'like', "%{$search}%")
                    ->orWhere('member_type', 'like', "%{$search}%");
            });
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.submissions.memberships', compact('submissions', 'status', 'search'));
    }

    /**
     * Update member status directly.
     */
    public function updateMembershipStatus(Request $request, Membership $membership): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $membership->update([
            'status' => $validated['status'],
            'is_read' => true,
        ]);

        return back()->with('status', 'Member status updated to '.ucfirst($validated['status']).'.');
    }

    /**
     * Delete a member directly.
     */
    public function destroyMembership(Membership $membership): RedirectResponse
    {
        $membership->delete();

        return back()->with('status', 'Member record deleted successfully.');
    }

    /**
     * Display Suggestions, Complaints, and Contacts directly from the Contact model.
     */
    public function contacts(Request $request): View
    {
        $status = $request->query('status', 'all');
        $type = $request->query('type', 'all');
        $search = $request->query('search');

        $query = Contact::query()->latest();

        if ($status !== 'all' && in_array($status, ['new', 'reviewed', 'resolved'], true)) {
            $query->where('status', $status);
        }

        if ($type !== 'all' && ! empty($type)) {
            $query->where('contact_type', $type);
        }

        if (! empty($search)) {
            $search = trim((string) $search);
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('cnic_number', 'like', "%{$search}%")
                    ->orWhere('email_address', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.submissions.contacts', compact('submissions', 'status', 'type', 'search'));
    }

    /**
     * Update contact message status.
     */
    public function updateContactStatus(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'max:50'],
        ]);

        $contact->update([
            'status' => $validated['status'],
            'is_read' => true,
        ]);

        return back()->with('status', 'Message status updated to '.ucfirst($validated['status']).'.');
    }

    /**
     * Delete contact message.
     */
    public function destroyContact(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('status', 'Message deleted successfully.');
    }
}
