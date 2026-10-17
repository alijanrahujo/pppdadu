@extends('layouts.admin', [
    'title' => 'Homepage Join Banner',
    'pageTitle' => 'Homepage &bull; Join Hands Banner'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.home.join.update') }}" method="POST">
            @csrf

            <div class="admin-card">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-handshake"></i> Bottom Join Hands Banner</h2>
                        <div class="admin-card-subtitle">Call-to-action section at the bottom of the homepage</div>
                    </div>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Heading <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['home.join.title'] ?? 'Join Hands For a Better Future') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="description" class="admin-label">Description <span class="required">*</span></label>
                                <textarea id="description" name="description" class="admin-textarea" rows="3" required>{{ old('description', $settings['home.join.description'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_primary_text" class="admin-label">Primary Button Text <span class="required">*</span></label>
                                <input type="text" id="btn_primary_text" name="btn_primary_text" class="admin-input" value="{{ old('btn_primary_text', $settings['home.join.btn_primary_text'] ?? 'Learn More') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_primary_url" class="admin-label">Primary Button Link <span class="required">*</span></label>
                                <input type="text" id="btn_primary_url" name="btn_primary_url" class="admin-input" value="{{ old('btn_primary_url', $settings['home.join.btn_primary_url'] ?? '/join') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_outline_text" class="admin-label">Outline Button Text <span class="required">*</span></label>
                                <input type="text" id="btn_outline_text" name="btn_outline_text" class="admin-input" value="{{ old('btn_outline_text', $settings['home.join.btn_outline_text'] ?? 'Our Vision') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_outline_url" class="admin-label">Outline Button Link <span class="required">*</span></label>
                                <input type="text" id="btn_outline_url" name="btn_outline_url" class="admin-input" value="{{ old('btn_outline_url', $settings['home.join.btn_outline_url'] ?? '#about') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Banner Settings</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
