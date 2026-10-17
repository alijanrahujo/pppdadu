@extends('layouts.admin', [
    'title' => 'Media Gallery',
    'pageTitle' => 'Media &bull; Photo Gallery Management'
])

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <!-- Category Filter Tabs -->
    <div class="btn-group" role="group">
        <a href="{{ route('admin.gallery.index', ['category' => 'all']) }}" class="btn btn-sm {{ $category === 'all' ? 'btn-success' : 'btn-outline-secondary' }}">
            All ({{ \App\Models\GalleryItem::count() }})
        </a>
        <a href="{{ route('admin.gallery.index', ['category' => 'functions']) }}" class="btn btn-sm {{ $category === 'functions' ? 'btn-success' : 'btn-outline-secondary' }}">
            Functions ({{ \App\Models\GalleryItem::where('category', 'functions')->count() }})
        </a>
        <a href="{{ route('admin.gallery.index', ['category' => 'railes']) }}" class="btn btn-sm {{ $category === 'railes' ? 'btn-success' : 'btn-outline-secondary' }}">
            Rallies ({{ \App\Models\GalleryItem::where('category', 'railes')->count() }})
        </a>
        <a href="{{ route('admin.gallery.index', ['category' => 'moments']) }}" class="btn btn-sm {{ $category === 'moments' ? 'btn-success' : 'btn-outline-secondary' }}">
            Moments ({{ \App\Models\GalleryItem::where('category', 'moments')->count() }})
        </a>
    </div>

    <a href="{{ route('admin.gallery.create', ['category' => $category === 'all' ? 'functions' : $category]) }}" class="admin-btn admin-btn-primary">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <span>Upload Photo</span>
    </a>
</div>

<div class="row g-3">
    @forelse ($items as $item)
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="admin-card h-100 d-flex flex-column">
                <div class="position-relative">
                    <img src="{{ $item->image_url }}" alt="{{ $item->alt }}" class="w-100" style="height: 180px; object-fit: cover;">
                    <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-75 text-capitalize">{{ $item->category }}</span>
                    @if ($item->is_featured_home)
                        <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark" title="Featured on Homepage Activities">
                            <i class="fa-solid fa-star"></i> Featured
                        </span>
                    @endif
                </div>
                <div class="admin-card-body flex-grow-1 p-3">
                    <strong class="d-block text-dark text-truncate">{{ $item->title ?: ($item->alt ?: 'Activity Photo') }}</strong>
                    <div class="text-muted small mt-1">Order: {{ $item->order }}</div>
                </div>
                <div class="admin-card-footer bg-light p-2 justify-content-between">
                    <span class="text-muted small">#{{ $item->id }}</span>
                    <div>
                        <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-outline-primary py-0 px-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this gallery photo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="admin-card text-center py-5">
                <i class="fa-regular fa-images fa-3x text-muted mb-3 d-block"></i>
                <h4 class="h5 text-muted">No Gallery Photos in this Category</h4>
                <p class="text-muted">Upload party functions, rallies, and convention photos.</p>
            </div>
        </div>
    @endforelse
</div>

@if ($items->hasPages())
    <div class="mt-4 d-flex justify-content-end">
        {{ $items->links() }}
    </div>
@endif
@endsection
