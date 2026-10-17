<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery items.
     */
    public function index(Request $request): View
    {
        $category = $request->query('category', 'all');

        $query = GalleryItem::query()->orderBy('order')->orderByDesc('id');

        if ($category !== 'all' && in_array($category, ['functions', 'railes', 'moments'], true)) {
            $query->where('category', $category);
        }

        $items = $query->paginate(24)->withQueryString();

        return view('admin.gallery.index', compact('items', 'category'));
    }

    /**
     * Show form for creating a new gallery item.
     */
    public function create(): View
    {
        return view('admin.gallery.form', [
            'item' => new GalleryItem([
                'category' => request('category', 'functions'),
                'is_featured_home' => false,
                'order' => GalleryItem::query()->max('order') + 1,
            ]),
        ]);
    }

    /**
     * Store a newly created gallery item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'alt' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'in:functions,railes,moments'],
            'is_featured_home' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:10240'],
        ]);

        $imagePath = $validated['image'] ?? null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/gallery', 'public');
        }

        if (empty($imagePath)) {
            return back()->withErrors(['image_file' => 'Please provide an image file or filename.'])->withInput();
        }

        GalleryItem::query()->create([
            'title' => $validated['title'] ?? null,
            'alt' => $validated['alt'] ?? $validated['title'] ?? 'Party activity image',
            'category' => $validated['category'],
            'is_featured_home' => $request->boolean('is_featured_home', false),
            'order' => $validated['order'] ?? 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.gallery.index', ['category' => $validated['category']])
            ->with('status', 'Gallery image added successfully.');
    }

    /**
     * Show form for editing the gallery item.
     */
    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.form', ['item' => $gallery]);
    }

    /**
     * Update the specified gallery item.
     */
    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'alt' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'in:functions,railes,moments'],
            'is_featured_home' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:10240'],
        ]);

        $imagePath = $gallery->image;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/gallery', 'public');
        } elseif ($request->filled('image')) {
            $imagePath = $validated['image'];
        }

        $gallery->update([
            'title' => $validated['title'] ?? null,
            'alt' => $validated['alt'] ?? $validated['title'] ?? 'Party activity image',
            'category' => $validated['category'],
            'is_featured_home' => $request->boolean('is_featured_home', false),
            'order' => $validated['order'] ?? 0,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.gallery.index', ['category' => $validated['category']])
            ->with('status', 'Gallery image updated successfully.');
    }

    /**
     * Remove the specified gallery item.
     */
    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $category = $gallery->category;
        $gallery->delete();

        return redirect()->route('admin.gallery.index', ['category' => $category])
            ->with('status', 'Gallery item deleted successfully.');
    }
}
