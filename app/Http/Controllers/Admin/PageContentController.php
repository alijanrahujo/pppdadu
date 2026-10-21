<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageContentController extends Controller
{
    /**
     * President Page Editor.
     */
    public function president(): View
    {
        $settings = SiteSetting::getGroup('page_president');

        return view('admin.pages.president', compact('settings'));
    }

    public function updatePresident(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'quote' => ['required', 'string'],
            'statement' => ['nullable', 'string'],
            'mission' => ['required', 'string'],
            'vision' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'principles' => ['required', 'array'],
            'principles.*' => ['required', 'string', 'max:150'],
            'achievements' => ['required', 'array'],
            'achievements.*.title' => ['required', 'string', 'max:150'],
            'achievements.*.description' => ['required', 'string'],
            'achievements.*.icon' => ['required', 'string', 'max:50'],
            'journey' => ['required', 'array'],
            'journey.*.period' => ['required', 'string', 'max:50'],
            'journey.*.description' => ['required', 'string'],
        ]);

        SiteSetting::set('president.title', $validated['title'], 'page_president');
        SiteSetting::set('president.eyebrow', $validated['eyebrow'], 'page_president');
        SiteSetting::set('president.name', $validated['name'], 'page_president');
        SiteSetting::set('president.role', $validated['role'], 'page_president');
        SiteSetting::set('president.description', $validated['description'], 'page_president', 'textarea');
        SiteSetting::set('president.quote', $validated['quote'], 'page_president', 'textarea');
        SiteSetting::set('president.statement', $request->input('statement', ''), 'page_president', 'textarea');
        SiteSetting::set('president.mission', $validated['mission'], 'page_president', 'textarea');
        SiteSetting::set('president.vision', $validated['vision'], 'page_president', 'textarea');
        SiteSetting::set('president.principles', array_values($validated['principles']), 'page_president', 'json');
        SiteSetting::set('president.achievements', array_values($validated['achievements']), 'page_president', 'json');
        SiteSetting::set('president.journey', array_values($validated['journey']), 'page_president', 'json');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/leaders', 'public');
            SiteSetting::set('president.image', $path, 'page_president');
        } elseif (! empty($validated['image'])) {
            SiteSetting::set('president.image', $validated['image'], 'page_president');
        }

        return back()->with('status', 'About President page content updated successfully.');
    }

    /**
     * General Secretary Page Editor.
     */
    public function generalSecretary(): View
    {
        $settings = SiteSetting::getGroup('page_general_secretary');

        return view('admin.pages.general-secretary', compact('settings'));
    }

    public function updateGeneralSecretary(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'quote' => ['required', 'string'],
            'statement' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'principles' => ['required', 'array'],
            'principles.*' => ['required', 'string', 'max:150'],
            'commitments' => ['required', 'array'],
            'commitments.*.title' => ['required', 'string', 'max:150'],
            'commitments.*.description' => ['required', 'string'],
            'commitments.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('general_secretary.title', $validated['title'], 'page_general_secretary');
        SiteSetting::set('general_secretary.eyebrow', $validated['eyebrow'], 'page_general_secretary');
        SiteSetting::set('general_secretary.name', $validated['name'], 'page_general_secretary');
        SiteSetting::set('general_secretary.role', $validated['role'], 'page_general_secretary');
        SiteSetting::set('general_secretary.description', $validated['description'], 'page_general_secretary', 'textarea');
        SiteSetting::set('general_secretary.quote', $validated['quote'], 'page_general_secretary', 'textarea');
        SiteSetting::set('general_secretary.statement', $request->input('statement', ''), 'page_general_secretary', 'textarea');
        SiteSetting::set('general_secretary.principles', array_values($validated['principles']), 'page_general_secretary', 'json');
        SiteSetting::set('general_secretary.commitments', array_values($validated['commitments']), 'page_general_secretary', 'json');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/leaders', 'public');
            SiteSetting::set('general_secretary.image', $path, 'page_general_secretary');
        } elseif (! empty($validated['image'])) {
            SiteSetting::set('general_secretary.image', $validated['image'], 'page_general_secretary');
        }

        return back()->with('status', 'About General Secretary page content updated successfully.');
    }

    /**
     * Leadership Page Content.
     */
    public function leadership(): View
    {
        $settings = SiteSetting::getGroup('page_leadership');

        return view('admin.pages.leadership', compact('settings'));
    }

    public function updateLeadership(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'principles' => ['required', 'array'],
            'principles.*.title' => ['required', 'string', 'max:150'],
            'principles.*.description' => ['required', 'string'],
            'principles.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('leadership.title', $validated['title'], 'page_leadership');
        SiteSetting::set('leadership.eyebrow', $validated['eyebrow'], 'page_leadership');
        SiteSetting::set('leadership.subtitle', $validated['subtitle'], 'page_leadership');
        SiteSetting::set('leadership.description', $validated['description'], 'page_leadership', 'textarea');
        SiteSetting::set('leadership.principles', array_values($validated['principles']), 'page_leadership', 'json');

        return back()->with('status', 'Our Leadership page content updated successfully.');
    }

    /**
     * District Body Page Content.
     */
    public function districtBody(): View
    {
        $settings = SiteSetting::getGroup('page_district_body');

        return view('admin.pages.district-body', compact('settings'));
    }

    public function updateDistrictBody(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'principles' => ['required', 'array'],
            'principles.*.title' => ['required', 'string', 'max:150'],
            'principles.*.description' => ['required', 'string'],
            'principles.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('district_body.title', $validated['title'], 'page_district_body');
        SiteSetting::set('district_body.eyebrow', $validated['eyebrow'], 'page_district_body');
        SiteSetting::set('district_body.subtitle', $validated['subtitle'], 'page_district_body');
        SiteSetting::set('district_body.description', $validated['description'], 'page_district_body', 'textarea');
        SiteSetting::set('district_body.principles', array_values($validated['principles']), 'page_district_body', 'json');

        return back()->with('status', 'District Body page content updated successfully.');
    }

    /**
     * Tehsil Bodies Page Content.
     */
    public function tehsilBodies(): View
    {
        $settings = SiteSetting::getGroup('page_tehsil_bodies');

        return view('admin.pages.tehsil-bodies', compact('settings'));
    }

    public function updateTehsilBodies(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'statistics' => ['nullable', 'array'],
            'statistics.*.value' => ['required', 'string', 'max:50'],
            'statistics.*.label' => ['required', 'string', 'max:100'],
            'statistics.*.icon' => ['required', 'string', 'max:50'],
            'statistics.*.color' => ['required', 'string', 'in:red,green'],
            'tehsils' => ['nullable', 'array'],
            'tehsils.*.name' => ['required', 'string', 'max:150'],
            'tehsils.*.urdu_name' => ['nullable', 'string', 'max:150'],
            'tehsils.*.tagline' => ['nullable', 'string', 'max:255'],
            'tehsils.*.description' => ['nullable', 'string'],
            'tehsils.*.image' => ['nullable', 'string', 'max:255'],
            'tehsils.*.image_file' => ['nullable', 'image', 'max:5120'],
            'tehsils.*.members' => ['nullable', 'array'],
            'tehsils.*.members.*.name' => ['required', 'string', 'max:150'],
            'tehsils.*.members.*.role' => ['required', 'string', 'max:150'],
            'tehsils.*.members.*.phone' => ['nullable', 'string', 'max:50'],
            'tehsils.*.members.*.image' => ['nullable', 'string', 'max:255'],
            'tehsils.*.members.*.image_file' => ['nullable', 'image', 'max:5120'],
            'priorities' => ['nullable', 'array'],
            'priorities.*.title' => ['required', 'string', 'max:150'],
            'priorities.*.description' => ['required', 'string'],
            'priorities.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('tehsil_bodies.title', $validated['title'], 'page_tehsil_bodies');
        SiteSetting::set('tehsil_bodies.eyebrow', $validated['eyebrow'], 'page_tehsil_bodies');
        SiteSetting::set('tehsil_bodies.subtitle', $validated['subtitle'], 'page_tehsil_bodies');
        SiteSetting::set('tehsil_bodies.description', $validated['description'], 'page_tehsil_bodies', 'textarea');

        if (isset($validated['statistics'])) {
            SiteSetting::set('tehsil_bodies.statistics', array_values($validated['statistics']), 'page_tehsil_bodies', 'json');
        }

        if (isset($validated['tehsils'])) {
            $processedTehsils = [];
            foreach ($validated['tehsils'] as $tIndex => $tehsilData) {
                $tehsilItem = [
                    'name' => $tehsilData['name'],
                    'urdu_name' => $tehsilData['urdu_name'] ?? null,
                    'tagline' => $tehsilData['tagline'] ?? null,
                    'description' => $tehsilData['description'] ?? null,
                    'image' => ! empty($tehsilData['image']) ? $tehsilData['image'] : null,
                    'members' => [],
                ];

                if ($request->hasFile("tehsils.{$tIndex}.image_file")) {
                    $tehsilItem['image'] = $request->file("tehsils.{$tIndex}.image_file")->store('uploads/tehsils', 'public');
                }

                if (isset($tehsilData['members']) && is_array($tehsilData['members'])) {
                    foreach ($tehsilData['members'] as $mIndex => $memberData) {
                        $memberItem = [
                            'name' => $memberData['name'],
                            'role' => $memberData['role'],
                            'phone' => $memberData['phone'] ?? null,
                            'image' => ! empty($memberData['image']) ? $memberData['image'] : null,
                        ];

                        if ($request->hasFile("tehsils.{$tIndex}.members.{$mIndex}.image_file")) {
                            $memberItem['image'] = $request->file("tehsils.{$tIndex}.members.{$mIndex}.image_file")->store('uploads/tehsil-members', 'public');
                        }

                        $tehsilItem['members'][] = $memberItem;
                    }
                }

                $processedTehsils[] = $tehsilItem;
            }

            SiteSetting::set('tehsil_bodies.tehsils', $processedTehsils, 'page_tehsil_bodies', 'json');
        }

        if (isset($validated['priorities'])) {
            SiteSetting::set('tehsil_bodies.priorities', array_values($validated['priorities']), 'page_tehsil_bodies', 'json');
        }

        return back()->with('status', 'Tehsil Bodies page content updated successfully.');
    }

    /**
     * Municipal Bodies Page Content.
     */
    public function municipalBodies(): View
    {
        $settings = SiteSetting::getGroup('page_municipal_bodies');

        return view('admin.pages.municipal-bodies', compact('settings'));
    }

    public function updateMunicipalBodies(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'statistics' => ['required', 'array'],
            'statistics.*.value' => ['required', 'string', 'max:50'],
            'statistics.*.label' => ['required', 'string', 'max:100'],
            'statistics.*.icon' => ['required', 'string', 'max:50'],
            'statistics.*.color' => ['required', 'string', 'in:red,green'],
            'priorities' => ['required', 'array'],
            'priorities.*.title' => ['required', 'string', 'max:150'],
            'priorities.*.description' => ['required', 'string'],
            'priorities.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('municipal_bodies.title', $validated['title'], 'page_municipal_bodies');
        SiteSetting::set('municipal_bodies.eyebrow', $validated['eyebrow'], 'page_municipal_bodies');
        SiteSetting::set('municipal_bodies.subtitle', $validated['subtitle'], 'page_municipal_bodies');
        SiteSetting::set('municipal_bodies.description', $validated['description'], 'page_municipal_bodies', 'textarea');
        SiteSetting::set('municipal_bodies.statistics', array_values($validated['statistics']), 'page_municipal_bodies', 'json');
        SiteSetting::set('municipal_bodies.priorities', array_values($validated['priorities']), 'page_municipal_bodies', 'json');

        return back()->with('status', 'Municipal & Town Bodies page content updated successfully.');
    }

    /**
     * Union Councils Page Header Content.
     */
    public function unionCouncils(): View
    {
        $settings = SiteSetting::getGroup('page_union_councils');

        return view('admin.pages.union-councils', compact('settings'));
    }

    public function updateUnionCouncils(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string'],
        ]);

        SiteSetting::set('union_councils.title', $validated['title'], 'page_union_councils');
        SiteSetting::set('union_councils.eyebrow', $validated['eyebrow'], 'page_union_councils');
        SiteSetting::set('union_councils.subtitle', $validated['subtitle'], 'page_union_councils', 'textarea');

        return back()->with('status', 'Union Councils header content updated successfully.');
    }

    /**
     * Join Page Content.
     */
    public function joinPage(): View
    {
        $settings = SiteSetting::getGroup('page_join');

        return view('admin.pages.join', compact('settings'));
    }

    public function updateJoinPage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string'],
            'principles' => ['required', 'array'],
            'principles.*.title' => ['required', 'string', 'max:150'],
            'principles.*.description' => ['required', 'string'],
            'principles.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('join.title', $validated['title'], 'page_join');
        SiteSetting::set('join.eyebrow', $validated['eyebrow'], 'page_join');
        SiteSetting::set('join.subtitle', $validated['subtitle'], 'page_join', 'textarea');
        SiteSetting::set('join.principles', array_values($validated['principles']), 'page_join', 'json');

        return back()->with('status', 'Join page content updated successfully.');
    }

    /**
     * Contact Page Content.
     */
    public function contactPage(): View
    {
        $settings = SiteSetting::getGroup('page_contact');

        return view('admin.pages.contact', compact('settings'));
    }

    public function updateContactPage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'eyebrow' => ['required', 'string', 'max:150'],
            'subtitle' => ['required', 'string'],
            'principles' => ['required', 'array'],
            'principles.*.title' => ['required', 'string', 'max:150'],
            'principles.*.description' => ['required', 'string'],
            'principles.*.icon' => ['required', 'string', 'max:50'],
        ]);

        SiteSetting::set('contact.title', $validated['title'], 'page_contact');
        SiteSetting::set('contact.eyebrow', $validated['eyebrow'], 'page_contact');
        SiteSetting::set('contact.subtitle', $validated['subtitle'], 'page_contact', 'textarea');
        SiteSetting::set('contact.principles', array_values($validated['principles']), 'page_contact', 'json');

        return back()->with('status', 'Contact page content updated successfully.');
    }
}
