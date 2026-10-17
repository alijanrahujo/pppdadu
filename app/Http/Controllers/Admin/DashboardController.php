<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Leader;
use App\Models\UnionCouncil;
use App\Models\WebsiteSubmission;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $membershipCount = WebsiteSubmission::query()->where('submission_type', 'membership')->count();
        $newMembershipCount = WebsiteSubmission::query()->where('submission_type', 'membership')->where('status', 'new')->count();
        $contactCount = WebsiteSubmission::query()->where('submission_type', 'contact')->count();
        $newContactCount = WebsiteSubmission::query()->where('submission_type', 'contact')->where('status', 'new')->count();
        $galleryCount = GalleryItem::query()->count();
        $leaderCount = Leader::query()->count();
        $councilCount = UnionCouncil::query()->count();

        $recentMemberships = WebsiteSubmission::query()
            ->where('submission_type', 'membership')
            ->latest()
            ->take(5)
            ->get();

        $recentContacts = WebsiteSubmission::query()
            ->where('submission_type', 'contact')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'membershipCount' => $membershipCount,
            'newMembershipCount' => $newMembershipCount,
            'contactCount' => $contactCount,
            'newContactCount' => $newContactCount,
            'galleryCount' => $galleryCount,
            'leaderCount' => $leaderCount,
            'councilCount' => $councilCount,
            'recentMemberships' => $recentMemberships,
            'recentContacts' => $recentContacts,
        ]);
    }
}
