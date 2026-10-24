@extends('layouts.admin', [
    'title' => 'Blogs & News Management',
    'pageTitle' => 'Media • Blogs & News Management'
])

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="d-flex flex-wrap align-items-center gap-2">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.blogs.index', ['category' => 'all']) }}" class="btn btn-sm {{ $category === 'all' ? 'btn-success' : 'btn-outline-secondary' }}">
                All ({{ \App\Models\Blog::count() }})
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('admin.blogs.index', ['category' => $cat]) }}" class="btn btn-sm {{ $category === $cat ? 'btn-success' : 'btn-outline-secondary' }}">
                    {{ $cat }} ({{ \App\Models\Blog::where('category', $cat)->count() }})
                </a>
            @endforeach
        </div>

        <form action="{{ route('admin.blogs.index') }}" method="GET" class="d-inline-flex ms-2">
            @if ($category !== 'all')
                <input type="hidden" name="category" value="{{ $category }}">
            @endif
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Search title or category..." value="{{ $search ?? '' }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                @if (!empty($search))
                    <a href="{{ route('admin.blogs.index', ['category' => $category]) }}" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i></a>
                @endif
            </div>
        </form>
    </div>

    <a href="{{ route('admin.blogs.create') }}" class="admin-btn admin-btn-primary">
        <i class="fa-solid fa-plus"></i>
        <span>Create Blog Post</span>
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h2 class="admin-card-title">
            <i class="fa-solid fa-newspaper"></i>
            All Articles ({{ $blogs->total() }})
        </h2>
        <span class="text-muted small">Manage articles, photo galleries, and video stories</span>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Media</th>
                    <th>Title &amp; Category</th>
                    <th>Media Types</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $b)
                    <tr>
                        <td>
                            <img src="{{ $b->image_url }}" alt="{{ $b->title }}" class="rounded" style="width: 60px; height: 42px; object-fit: cover;">
                        </td>
                        <td>
                            <strong class="d-block text-dark">{{ $b->title }}</strong>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <span class="badge bg-light text-dark border">{{ $b->category }}</span>
                                @if ($b->is_featured)
                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-star"></i> Featured</span>
                                @endif
                                <small class="text-muted">{{ $b->read_time }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @if (!empty($b->image))
                                    <span class="badge bg-info text-dark" title="Cover Photo"><i class="fa-solid fa-image"></i> Photo</span>
                                @endif
                                @if ($b->has_video)
                                    <span class="badge bg-danger" title="Video available"><i class="fa-solid fa-play"></i> Video</span>
                                @endif
                                @if (!empty($b->photos) && count($b->photos) > 0)
                                    <span class="badge bg-success" title="{{ count($b->photos) }} Gallery Photos"><i class="fa-regular fa-images"></i> +{{ count($b->photos) }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-muted border"><i class="fa-regular fa-eye me-1"></i> {{ number_format($b->views_count) }}</span>
                        </td>
                        <td>
                            @if ($b->is_published)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Published</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border">Draft</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted d-block">{{ $b->published_at ? $b->published_at->format('M d, Y') : $b->created_at->format('M d, Y') }}</small>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('pages.blogs.show', $b->slug) }}" target="_blank" class="btn btn-outline-secondary" title="View on site">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <a href="{{ route('admin.blogs.edit', $b) }}" class="btn btn-outline-primary" title="Edit Post">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            No blog posts found. <a href="{{ route('admin.blogs.create') }}">Create the first article</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($blogs->hasPages())
        <div class="admin-card-footer">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
