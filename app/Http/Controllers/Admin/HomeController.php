<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Hero Section Editor.
     */
    public function hero(): View
    {
        $settings = SiteSetting::query()
            ->where('group', 'home_hero')
            ->pluck('value', 'key');

        return view('admin.home.hero', compact('settings'));
    }

    public function updateHero(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:500'],
            'btn_primary_text' => ['required', 'string', 'max:100'],
            'btn_primary_url' => ['required', 'string', 'max:255'],
            'btn_outline_text' => ['required', 'string', 'max:100'],
            'btn_outline_url' => ['required', 'string', 'max:255'],
            'video' => ['nullable', 'string', 'max:255'],
            'poster' => ['nullable', 'string', 'max:255'],
            'poster_file' => ['nullable', 'image', 'max:5120'],
            'leader_left_1' => ['nullable', 'string', 'max:255'],
            'leader_left_1_name' => ['nullable', 'string', 'max:255'],
            'leader_left_1_file' => ['nullable', 'image', 'max:5120'],
            'leader_left_2' => ['nullable', 'string', 'max:255'],
            'leader_left_2_name' => ['nullable', 'string', 'max:255'],
            'leader_left_2_file' => ['nullable', 'image', 'max:5120'],
            'leader_center_1' => ['nullable', 'string', 'max:255'],
            'leader_center_1_name' => ['nullable', 'string', 'max:255'],
            'leader_center_1_file' => ['nullable', 'image', 'max:5120'],
            'leader_center_2' => ['nullable', 'string', 'max:255'],
            'leader_center_2_name' => ['nullable', 'string', 'max:255'],
            'leader_center_2_file' => ['nullable', 'image', 'max:5120'],
            'leader_right_1' => ['nullable', 'string', 'max:255'],
            'leader_right_1_name' => ['nullable', 'string', 'max:255'],
            'leader_right_1_file' => ['nullable', 'image', 'max:5120'],
            'leader_right_2' => ['nullable', 'string', 'max:255'],
            'leader_right_2_name' => ['nullable', 'string', 'max:255'],
            'leader_right_2_file' => ['nullable', 'image', 'max:5120'],
        ]);

        SiteSetting::set('home.hero.title', $validated['title'], 'home_hero');
        SiteSetting::set('home.hero.district', $validated['district'], 'home_hero');
        SiteSetting::set('home.hero.subtitle', $validated['subtitle'], 'home_hero');
        SiteSetting::set('home.hero.btn_primary_text', $validated['btn_primary_text'], 'home_hero');
        SiteSetting::set('home.hero.btn_primary_url', $validated['btn_primary_url'], 'home_hero');
        SiteSetting::set('home.hero.btn_outline_text', $validated['btn_outline_text'], 'home_hero');
        SiteSetting::set('home.hero.btn_outline_url', $validated['btn_outline_url'], 'home_hero');
        SiteSetting::set('home.hero.video', $validated['video'] ?? 'Assets/video/hero-section-bg.mp4', 'home_hero');

        // Poster
        if ($request->hasFile('poster_file')) {
            $path = $request->file('poster_file')->store('uploads/hero', 'public');
            SiteSetting::set('home.hero.poster', $path, 'home_hero');
        } elseif (! empty($validated['poster'])) {
            SiteSetting::set('home.hero.poster', $validated['poster'], 'home_hero');
        }

        // 6 Hero Leadership Slots (Top Left 1 & 2, Top Center 1 & 2, Top Right 1 & 2)
        $leaderSlots = [
            'leader_left_1',
            'leader_left_2',
            'leader_center_1',
            'leader_center_2',
            'leader_right_1',
            'leader_right_2',
        ];

        foreach ($leaderSlots as $slot) {
            $fileKey = "{$slot}_file";
            $nameKey = "{$slot}_name";

            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('uploads/hero', 'public');
                SiteSetting::set("home.hero.{$slot}", $path, 'home_hero');
            } elseif (! empty($validated[$slot])) {
                SiteSetting::set("home.hero.{$slot}", $validated[$slot], 'home_hero');
            }

            if (isset($validated[$nameKey])) {
                SiteSetting::set("home.hero.{$nameKey}", $validated[$nameKey], 'home_hero');
            }
        }

        return back()->with('status', 'Homepage Hero Section updated successfully.');
    }

    /**
     * Party Values Strip Editor.
     */
    public function values(): View
    {
        $values = SiteSetting::get('home.values', []);

        return view('admin.home.values', compact('values'));
    }

    public function updateValues(Request $request): RedirectResponse
    {
        $request->validate([
            'values' => ['required', 'array', 'min:1'],
            'values.*.title' => ['required', 'string', 'max:150'],
            'values.*.subtitle' => ['required', 'string', 'max:255'],
            'values.*.icon' => ['required', 'string', 'max:50'],
            'values.*.color' => ['required', 'string', 'in:green,red,black'],
        ]);

        SiteSetting::set('home.values', $request->input('values'), 'home_values', 'json');

        return back()->with('status', 'Party Values updated successfully.');
    }

    /**
     * Deputy Information Secretary Profile Editor.
     */
    public function profile(): View
    {
        $settings = SiteSetting::query()
            ->where('group', 'home_profile')
            ->pluck('value', 'key');

        return view('admin.home.profile', compact('settings'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
            'bio1' => ['required', 'string'],
            'bio2' => ['nullable', 'string'],
        ]);

        SiteSetting::set('home.profile.name', $validated['name'], 'home_profile');
        SiteSetting::set('home.profile.role', $validated['role'], 'home_profile');
        SiteSetting::set('home.profile.bio1', $validated['bio1'], 'home_profile', 'textarea');
        SiteSetting::set('home.profile.bio2', $validated['bio2'] ?? '', 'home_profile', 'textarea');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/profile', 'public');
            SiteSetting::set('home.profile.image', $path, 'home_profile');
        } elseif (! empty($validated['image'])) {
            SiteSetting::set('home.profile.image', $validated['image'], 'home_profile');
        }

        return back()->with('status', 'Deputy Information Secretary Profile updated successfully.');
    }

    /**
     * About Section Editor.
     */
    public function about(): View
    {
        $eyebrow = SiteSetting::get('home.about.eyebrow');
        $title = SiteSetting::get('home.about.title');
        $description = SiteSetting::get('home.about.description');
        $principles = SiteSetting::get('home.about.principles', []);
        $stats = SiteSetting::get('home.about.stats', []);
        $image = SiteSetting::get('home.about.image');

        return view('admin.home.about', compact('eyebrow', 'title', 'description', 'principles', 'stats', 'image'));
    }

    public function updateAbout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'eyebrow' => ['required', 'string', 'max:150'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'principles' => ['required', 'array'],
            'principles.*' => ['required', 'string', 'max:100'],
            'stats' => ['required', 'array'],
            'stats.*.value' => ['required', 'string', 'max:50'],
            'stats.*.label' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
        ]);

        SiteSetting::set('home.about.eyebrow', $validated['eyebrow'], 'home_about');
        SiteSetting::set('home.about.title', $validated['title'], 'home_about');
        SiteSetting::set('home.about.description', $validated['description'], 'home_about', 'textarea');
        SiteSetting::set('home.about.principles', array_values($validated['principles']), 'home_about', 'json');
        SiteSetting::set('home.about.stats', array_values($validated['stats']), 'home_about', 'json');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/about', 'public');
            SiteSetting::set('home.about.image', $path, 'home_about');
        } elseif (! empty($validated['image'])) {
            SiteSetting::set('home.about.image', $validated['image'], 'home_about');
        }

        return back()->with('status', 'Homepage About Section updated successfully.');
    }

    /**
     * Join Callout Section Editor.
     */
    public function join(): View
    {
        $settings = SiteSetting::query()
            ->where('group', 'home_join')
            ->pluck('value', 'key');

        return view('admin.home.join', compact('settings'));
    }

    public function updateJoin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'btn_primary_text' => ['required', 'string', 'max:100'],
            'btn_primary_url' => ['required', 'string', 'max:255'],
            'btn_outline_text' => ['required', 'string', 'max:100'],
            'btn_outline_url' => ['required', 'string', 'max:255'],
        ]);

        SiteSetting::set('home.join.title', $validated['title'], 'home_join');
        SiteSetting::set('home.join.description', $validated['description'], 'home_join', 'textarea');
        SiteSetting::set('home.join.btn_primary_text', $validated['btn_primary_text'], 'home_join');
        SiteSetting::set('home.join.btn_primary_url', $validated['btn_primary_url'], 'home_join');
        SiteSetting::set('home.join.btn_outline_text', $validated['btn_outline_text'], 'home_join');
        SiteSetting::set('home.join.btn_outline_url', $validated['btn_outline_url'], 'home_join');

        return back()->with('status', 'Homepage Join Section updated successfully.');
    }
}
