<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show general site settings.
     */
    public function general(): View
    {
        $settings = SiteSetting::query()
            ->whereIn('group', ['general', 'social'])
            ->pluck('value', 'key');

        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update general site settings.
     */
    public function updateGeneral(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_title' => ['required', 'string', 'max:255'],
            'site_name' => ['required', 'string', 'max:255'],
            'site_district' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:500'],
            'site_phone' => ['nullable', 'string', 'max:50'],
            'site_email' => ['nullable', 'email', 'max:100'],
            'site_address' => ['nullable', 'string', 'max:500'],
            'site_facebook' => ['nullable', 'url', 'max:255'],
            'site_twitter' => ['nullable', 'url', 'max:255'],
            'site_youtube' => ['nullable', 'url', 'max:255'],
        ]);

        SiteSetting::set('site.title', $validated['site_title'], 'general');
        SiteSetting::set('site.name', $validated['site_name'], 'general');
        SiteSetting::set('site.district', $validated['site_district'], 'general');
        SiteSetting::set('site.tagline', $validated['site_tagline'] ?? '', 'general');
        SiteSetting::set('site.phone', $validated['site_phone'] ?? '', 'general');
        SiteSetting::set('site.email', $validated['site_email'] ?? '', 'general');
        SiteSetting::set('site.address', $validated['site_address'] ?? '', 'general');
        SiteSetting::set('site.facebook', $validated['site_facebook'] ?? '', 'social');
        SiteSetting::set('site.twitter', $validated['site_twitter'] ?? '', 'social');
        SiteSetting::set('site.youtube', $validated['site_youtube'] ?? '', 'social');

        return back()->with('status', 'General settings updated successfully.');
    }
}
