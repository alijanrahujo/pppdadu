<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaderController extends Controller
{
    /**
     * Display a listing of leaders.
     */
    public function index(Request $request): View
    {
        $category = $request->query('category', 'all');

        $query = Leader::query()->orderBy('category')->orderBy('order')->orderBy('id');

        if ($category !== 'all' && in_array($category, ['central_leadership', 'leadership_slider', 'district_body'], true)) {
            $query->where('category', $category);
        }

        $leaders = $query->paginate(20)->withQueryString();

        return view('admin.leaders.index', compact('leaders', 'category'));
    }

    /**
     * Show the form for creating a new leader.
     */
    public function create(): View
    {
        return view('admin.leaders.form', [
            'leader' => new Leader([
                'category' => request('category', 'leadership_slider'),
                'district' => 'District Dadu',
                'is_active' => true,
                'order' => Leader::query()->max('order') + 1,
            ]),
        ]);
    }

    /**
     * Store a newly created leader.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:central_leadership,leadership_slider,district_body'],
            'link' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
        ]);

        $imagePath = $validated['image'] ?? null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/leaders', 'public');
        }

        Leader::query()->create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'district' => $validated['district'],
            'category' => $validated['category'],
            'link' => $validated['link'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.leaders.index', ['category' => $validated['category']])
            ->with('status', 'Leader added successfully.');
    }

    /**
     * Show the form for editing the specified leader.
     */
    public function edit(Leader $leader): View
    {
        return view('admin.leaders.form', compact('leader'));
    }

    /**
     * Update the specified leader.
     */
    public function update(Request $request, Leader $leader): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:central_leadership,leadership_slider,district_body'],
            'link' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:5120'],
        ]);

        $imagePath = $leader->image;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/leaders', 'public');
        } elseif ($request->filled('image')) {
            $imagePath = $validated['image'];
        }

        $leader->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'district' => $validated['district'],
            'category' => $validated['category'],
            'link' => $validated['link'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.leaders.index', ['category' => $validated['category']])
            ->with('status', 'Leader updated successfully.');
    }

    /**
     * Remove the specified leader.
     */
    public function destroy(Leader $leader): RedirectResponse
    {
        $category = $leader->category;
        $leader->delete();

        return redirect()->route('admin.leaders.index', ['category' => $category])
            ->with('status', 'Leader removed successfully.');
    }
}
