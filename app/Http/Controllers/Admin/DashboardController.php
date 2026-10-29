<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\GalleryItem;
use App\Models\Leader;
use App\Models\Membership;
use App\Models\UnionCouncil;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $membershipCount = Membership::query()->count();
        $newMembershipCount = Membership::query()->where('status', 'new')->count();
        $contactCount = Contact::query()->count();
        $newContactCount = Contact::query()->where('status', 'new')->count();
        $blogCount = Blog::query()->count();
        $galleryCount = GalleryItem::query()->count();
        $leaderCount = Leader::query()->count();
        $councilCount = UnionCouncil::query()->count();

        $recentMemberships = Membership::query()
            ->latest()
            ->take(5)
            ->get();

        $recentContacts = Contact::query()
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'membershipCount' => $membershipCount,
            'newMembershipCount' => $newMembershipCount,
            'contactCount' => $contactCount,
            'newContactCount' => $newContactCount,
            'blogCount' => $blogCount,
            'galleryCount' => $galleryCount,
            'leaderCount' => $leaderCount,
            'councilCount' => $councilCount,
            'recentMemberships' => $recentMemberships,
            'recentContacts' => $recentContacts,
        ]);
    }
}
