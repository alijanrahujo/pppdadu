@extends('layouts.admin', [
    'title' => ($leader->exists ? 'Edit Leader: ' . $leader->name : 'Add New Leader'),
    'pageTitle' => ($leader->exists ? 'Edit Leader &bull; ' . $leader->name : 'Add New Leader')
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <form action="{{ $leader->exists ? route('admin.leaders.update', $leader) : route('admin.leaders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($leader->exists)
                @method('PUT')
            @endif

            <div class="admin-card">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <h2 class="admin-card-title">
                        <i class="fa-solid fa-user"></i>
                        {{ $leader->exists ? 'Edit Leader Details' : 'New Leader Information' }}
                    </h2>
                    <a href="{{ route('admin.leaders.index', ['category' => $leader->category]) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Leaders
                    </a>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="name" class="admin-label">Full Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" class="admin-input" value="{{ old('name', $leader->name) }}" required placeholder="e.g. Barrister Pir Mujeeb-ul-Haq">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="role" class="admin-label">Designation / Role <span class="required">*</span></label>
                                <input type="text" id="role" name="role" class="admin-input" value="{{ old('role', $leader->role) }}" required placeholder="e.g. District President">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="category" class="admin-label">Category / Placement <span class="required">*</span></label>
                                <select id="category" name="category" class="admin-select" required>
                                    <option value="central_leadership" {{ old('category', $leader->category) === 'central_leadership' ? 'selected' : '' }}>Central Party Leadership</option>
                                    <option value="leadership_slider" {{ old('category', $leader->category) === 'leadership_slider' ? 'selected' : '' }}>Homepage Leadership Slider</option>
                                    <option value="district_body" {{ old('category', $leader->category) === 'district_body' ? 'selected' : '' }}>District Body Office Bearers</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="district" class="admin-label">District / Constituency</label>
                                <input type="text" id="district" name="district" class="admin-input" value="{{ old('district', $leader->district ?? 'District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="admin-form-group">
                                <label for="link" class="admin-label">Target Page Link (Optional)</label>
                                <input type="text" id="link" name="link" class="admin-input" value="{{ old('link', $leader->link) }}" placeholder="e.g. /about/president">
                                <div class="admin-help">Clicking the leader card on the homepage slider navigates here.</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="order" class="admin-label">Display Order</label>
                                <input type="number" id="order" name="order" class="admin-input" value="{{ old('order', $leader->order ?? 0) }}" min="0">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label class="admin-label">Leader Portrait Photo</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="leaderPreview">
                                <input type="hidden" name="image" value="{{ $leader->image ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderPreview" src="{{ $leader->image_url }}" class="admin-img-preview" alt="Preview">
                                    <span class="text-muted small">Upload portrait image (JPEG/PNG/WebP, max 5MB)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $leader->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Active (Display on website)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ $leader->exists ? 'Update Leader' : 'Save Leader' }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
