@extends('layouts.admin', [
    'title' => ($item->exists ? 'Edit Photo' : 'Upload Gallery Photo'),
    'pageTitle' => ($item->exists ? 'Edit Gallery Photo &bull; #' . $item->id : 'Upload Gallery Photo')
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <form action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($item->exists)
                @method('PUT')
            @endif

            <div class="admin-card">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <h2 class="admin-card-title">
                        <i class="fa-solid fa-image"></i>
                        {{ $item->exists ? 'Edit Photo Details' : 'Upload New Gallery Photo' }}
                    </h2>
                    <a href="{{ route('admin.gallery.index', ['category' => $item->category]) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Gallery
                    </a>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Photo Title / Caption</label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $item->title) }}" placeholder="e.g. Workers Convention Dadu">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="category" class="admin-label">Category <span class="required">*</span></label>
                                <select id="category" name="category" class="admin-select" required>
                                    <option value="functions" {{ old('category', $item->category) === 'functions' ? 'selected' : '' }}>Party Functions &amp; Events</option>
                                    <option value="railes" {{ old('category', $item->category) === 'railes' ? 'selected' : '' }}>Public Rallies &amp; Processions</option>
                                    <option value="moments" {{ old('category', $item->category) === 'moments' ? 'selected' : '' }}>Historical Moments &amp; Outreach</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="admin-form-group">
                                <label for="alt" class="admin-label">Alternative Text (Accessibility / SEO)</label>
                                <input type="text" id="alt" name="alt" class="admin-input" value="{{ old('alt', $item->alt) }}" placeholder="Description of the image content">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="order" class="admin-label">Display Order</label>
                                <input type="number" id="order" name="order" class="admin-input" value="{{ old('order', $item->order ?? 0) }}" min="0">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label class="admin-label">Photo File <span class="{{ $item->exists ? '' : 'required' }}">*</span></label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="galleryPreview" {{ $item->exists ? '' : 'required' }}>
                                <input type="hidden" name="image" value="{{ $item->image ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="galleryPreview" src="{{ $item->exists ? $item->image_url : asset('Assets/images/images-8.jpg') }}" class="admin-img-preview" alt="Preview" style="width: 100px; height: 75px;">
                                    <span class="text-muted small">Supports high-res JPEG, PNG, WebP (up to 10MB)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_featured_home" name="is_featured_home" value="1" {{ old('is_featured_home', $item->is_featured_home) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_featured_home">
                                    Feature on Homepage (Show in "Moments from Our Activities" slider)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ $item->exists ? 'Update Photo' : 'Upload Photo' }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
