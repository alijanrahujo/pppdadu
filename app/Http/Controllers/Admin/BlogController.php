<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $category = $request->query('category', 'all');

        $query = Blog::query()->latest('id');

        if (! empty($search)) {
            $search = trim((string) $search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category !== 'all' && ! empty($category)) {
            $query->where('category', $category);
        }

        $blogs = $query->paginate(15)->withQueryString();
        $categories = Blog::distinct()->pluck('category')->filter()->values()->all();

        return view('admin.blogs.index', compact('blogs', 'search', 'category', 'categories'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create(): View
    {
        return view('admin.blogs.form', [
            'blog' => new Blog([
                'category' => request('category', 'Development & Welfare'),
                'read_time' => '4 min read',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now(),
            ]),
            'categories' => ['Development & Welfare', 'Party News', 'Press Releases', 'Speeches & Statements', 'Youth & Community'],
        ]);
    }

    /**
     * Store a newly created blog post.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:10240'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg,video/quicktime', 'max:102400'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'photo_files' => ['nullable', 'array'],
            'photo_files.*' => ['image', 'max:10240'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'tags_input' => ['nullable', 'string', 'max:500'],
        ]);

        $slug = ! empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['title']).'-'.rand(100, 999);

        // Featured image
        $imagePath = $validated['image'] ?? null;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/blogs', 'public');
        }

        // Uploaded video file
        $videoPath = null;
        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('uploads/blogs/videos', 'public');
        }

        // Uploaded gallery photos
        $photos = [];
        if ($request->hasFile('photo_files')) {
            foreach ($request->file('photo_files') as $file) {
                if ($file->isValid()) {
                    $photos[] = $file->store('uploads/blogs/gallery', 'public');
                }
            }
        }

        // Tags
        $tags = [];
        if (! empty($validated['tags_input'])) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $validated['tags_input']))));
        }

        Blog::query()->create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'image' => $imagePath,
            'video' => $videoPath,
            'video_url' => $validated['video_url'] ?? null,
            'photos' => $photos,
            'read_time' => $validated['read_time'] ?? '4 min read',
            'is_featured' => $request->boolean('is_featured', false),
            'is_published' => $request->boolean('is_published', true),
            'published_at' => $validated['published_at'] ?? now(),
            'tags' => $tags,
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('status', 'Blog post created successfully with uploaded media.');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(Blog $blog): View
    {
        return view('admin.blogs.form', [
            'blog' => $blog,
            'categories' => ['Development & Welfare', 'Party News', 'Press Releases', 'Speeches & Statements', 'Youth & Community'],
        ]);
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug,'.$blog->id],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:10240'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg,video/quicktime', 'max:102400'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'photo_files' => ['nullable', 'array'],
            'photo_files.*' => ['image', 'max:10240'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'tags_input' => ['nullable', 'string', 'max:500'],
            'remove_video' => ['nullable', 'boolean'],
        ]);

        $imagePath = $blog->image;
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('uploads/blogs', 'public');
        } elseif ($request->filled('image')) {
            $imagePath = $validated['image'];
        }

        $videoPath = $blog->video;
        if ($request->boolean('remove_video')) {
            $videoPath = null;
        } elseif ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('uploads/blogs/videos', 'public');
        }

        $photos = $blog->photos ?? [];
        if ($request->hasFile('photo_files')) {
            foreach ($request->file('photo_files') as $file) {
                if ($file->isValid()) {
                    $photos[] = $file->store('uploads/blogs/gallery', 'public');
                }
            }
        }

        $tags = [];
        if (! empty($validated['tags_input'])) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $validated['tags_input']))));
        }

        $slug = ! empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : ($blog->slug ?: Str::slug($validated['title']).'-'.rand(100, 999));

        $blog->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'image' => $imagePath,
            'video' => $videoPath,
            'video_url' => $validated['video_url'] ?? null,
            'photos' => $photos,
            'read_time' => $validated['read_time'] ?? $blog->read_time,
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : $blog->is_featured,
            'is_published' => $request->has('is_published') ? $request->boolean('is_published') : $blog->is_published,
            'published_at' => $validated['published_at'] ?? $blog->published_at,
            'tags' => $tags,
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('status', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('status', 'Blog post deleted successfully.');
    }
}
