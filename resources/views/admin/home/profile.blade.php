@extends('layouts.admin', [
    'title' => 'Deputy Info Secretary Profile',
    'pageTitle' => 'Homepage &bull; Deputy Information Secretary Profile'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.home.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="admin-card">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-id-badge"></i> Profile Section (Homepage)</h2>
                        <div class="admin-card-subtitle">Information Secretary profile and party digital communication bio</div>
                    </div>
                </div>
                <div class="admin-card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="name" class="admin-label">Full Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" class="admin-input" value="{{ old('name', $settings['home.profile.name'] ?? 'Sajad Ahmed Junejo') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="role" class="admin-label">Official Designation / Role <span class="required">*</span></label>
                                <input type="text" id="role" name="role" class="admin-input" value="{{ old('role', $settings['home.profile.role'] ?? 'Website Operator | Deputy Information Secretary, Pakistan Peoples Party, District Dadu (Sindh)') }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="admin-form-group">
                                <label class="admin-label">Official Profile Cutout Photo</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="profilePreview">
                                <input type="hidden" name="image" value="{{ $settings['home.profile.image'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="profilePreview" src="{{ media_asset($settings['home.profile.image'] ?? 'Assets/images/Professional-Portrait-Cutout-on-Transparency.png') }}" class="admin-img-preview" alt="Profile Preview">
                                    <span class="text-muted small">Upload portrait image (PNG with transparency or solid portrait)</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="bio1" class="admin-label">Biography Paragraph 1 <span class="required">*</span></label>
                                <textarea id="bio1" name="bio1" class="admin-textarea" rows="3" required>{{ old('bio1', $settings['home.profile.bio1'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="bio2" class="admin-label">Biography Paragraph 2</label>
                                <textarea id="bio2" name="bio2" class="admin-textarea" rows="3">{{ old('bio2', $settings['home.profile.bio2'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Profile Changes</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
