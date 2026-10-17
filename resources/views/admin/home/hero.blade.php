@extends('layouts.admin', [
    'title' => 'Homepage Hero Section',
    'pageTitle' => 'Homepage &bull; Hero Section &amp; Background'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.home.hero.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Text & Headings -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-heading"></i> Hero Headings &amp; Slogan</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Main Heading <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['home.hero.title'] ?? 'Pakistan Peoples Party') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="district" class="admin-label">District Sub-title <span class="required">*</span></label>
                                <input type="text" id="district" name="district" class="admin-input" value="{{ old('district', $settings['home.hero.district'] ?? 'District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="subtitle" class="admin-label">Lead Slogan / Description <span class="required">*</span></label>
                                <textarea id="subtitle" name="subtitle" class="admin-textarea" rows="2" required>{{ old('subtitle', $settings['home.hero.subtitle'] ?? 'Committed to Democracy, Social Justice and welfare of the people') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action Buttons -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-computer-mouse"></i> Action Buttons</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_primary_text" class="admin-label">Primary Button Text <span class="required">*</span></label>
                                <input type="text" id="btn_primary_text" name="btn_primary_text" class="admin-input" value="{{ old('btn_primary_text', $settings['home.hero.btn_primary_text'] ?? 'Learn More') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_primary_url" class="admin-label">Primary Button Link <span class="required">*</span></label>
                                <input type="text" id="btn_primary_url" name="btn_primary_url" class="admin-input" value="{{ old('btn_primary_url', $settings['home.hero.btn_primary_url'] ?? '/about/president') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_outline_text" class="admin-label">Outline Button Text <span class="required">*</span></label>
                                <input type="text" id="btn_outline_text" name="btn_outline_text" class="admin-input" value="{{ old('btn_outline_text', $settings['home.hero.btn_outline_text'] ?? 'Our Vision') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="btn_outline_url" class="admin-label">Outline Button Link <span class="required">*</span></label>
                                <input type="text" id="btn_outline_url" name="btn_outline_url" class="admin-input" value="{{ old('btn_outline_url', $settings['home.hero.btn_outline_url'] ?? '#about') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video & Imagery -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-photo-film"></i> Background Video &amp; Visuals</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="admin-form-group">
                                <label for="video" class="admin-label">Background Video Asset Path / URL</label>
                                <input type="text" id="video" name="video" class="admin-input" value="{{ old('video', $settings['home.hero.video'] ?? 'Assets/video/hero-section-bg.mp4') }}">
                                <div class="admin-help">Path to MP4 video played in hero background. Default: <code>Assets/video/hero-section-bg.mp4</code></div>
                            </div>
                        </div>

                        <!-- Video Poster -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Video Poster Fallback Image</label>
                                <input type="file" name="poster_file" class="form-control form-control-sm" accept="image/*" data-preview="posterPreview">
                                <input type="hidden" name="poster" value="{{ $settings['home.hero.poster'] ?? '' }}">
                                <div class="admin-img-preview-wrap">
                                    <img id="posterPreview" src="{{ media_asset($settings['home.hero.poster'] ?? 'Assets/images/Mass-Rally-Beneath-a-Crescent-Flag.jpg') }}" class="admin-img-preview" alt="Poster Preview">
                                    <span class="text-muted small">Shown while video loads or on mobile data saver.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Left 1: Ali Hassan Zardari -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Top Left #1 (Ali Hassan Zardari)</label>
                                <input type="text" name="leader_left_1_name" class="admin-input mb-2" value="{{ old('leader_left_1_name', $settings['home.hero.leader_left_1_name'] ?? 'Ali Hassan Zardari') }}" placeholder="Leader Name">
                                <input type="file" name="leader_left_1_file" class="form-control form-control-sm" accept="image/*" data-preview="leaderLeft1Preview">
                                <input type="hidden" name="leader_left_1" value="{{ $settings['home.hero.leader_left_1'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderLeft1Preview" src="{{ media_asset($settings['home.hero.leader_left_1'] ?? 'Assets/images/hero/ali-hassan-zardari.jpg') }}" class="admin-img-preview rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="Top Left 1">
                                    <span class="text-muted small">Default: <code>Assets/images/hero/ali-hassan-zardari.jpg</code></span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Left 2: Faryal Talpur -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Top Left #2 (Faryal Talpur)</label>
                                <input type="text" name="leader_left_2_name" class="admin-input mb-2" value="{{ old('leader_left_2_name', $settings['home.hero.leader_left_2_name'] ?? 'Faryal Talpur') }}" placeholder="Leader Name">
                                <input type="file" name="leader_left_2_file" class="form-control form-control-sm" accept="image/*" data-preview="leaderLeft2Preview">
                                <input type="hidden" name="leader_left_2" value="{{ $settings['home.hero.leader_left_2'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderLeft2Preview" src="{{ media_asset($settings['home.hero.leader_left_2'] ?? 'Assets/images/hero/faryal-talpur.jpg') }}" class="admin-img-preview rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="Top Left 2">
                                    <span class="text-muted small">Default: <code>Assets/images/hero/faryal-talpur.jpg</code></span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Center 1: Zulfikar Ali Bhutto -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Top Center #1 (Zulfikar Ali Bhutto)</label>
                                <input type="text" name="leader_center_1_name" class="admin-input mb-2" value="{{ old('leader_center_1_name', $settings['home.hero.leader_center_1_name'] ?? 'Zulfikar Ali Bhutto') }}" placeholder="Leader Name">
                                <input type="file" name="leader_center_1_file" class="form-control form-control-sm" accept="image/*" data-preview="leaderCenter1Preview">
                                <input type="hidden" name="leader_center_1" value="{{ $settings['home.hero.leader_center_1'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderCenter1Preview" src="{{ media_asset($settings['home.hero.leader_center_1'] ?? 'Assets/images/hero/zulfikar-ali-bhutto.jpg') }}" class="admin-img-preview rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="Top Center 1">
                                    <span class="text-muted small">Default: <code>Assets/images/hero/zulfikar-ali-bhutto.jpg</code></span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Center 2: Benazir Bhutto -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Top Center #2 (Benazir Bhutto)</label>
                                <input type="text" name="leader_center_2_name" class="admin-input mb-2" value="{{ old('leader_center_2_name', $settings['home.hero.leader_center_2_name'] ?? 'Benazir Bhutto') }}" placeholder="Leader Name">
                                <input type="file" name="leader_center_2_file" class="form-control form-control-sm" accept="image/*" data-preview="leaderCenter2Preview">
                                <input type="hidden" name="leader_center_2" value="{{ $settings['home.hero.leader_center_2'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderCenter2Preview" src="{{ media_asset($settings['home.hero.leader_center_2'] ?? 'Assets/images/hero/benazir-bhutto.jpg') }}" class="admin-img-preview rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="Top Center 2">
                                    <span class="text-muted small">Default: <code>Assets/images/hero/benazir-bhutto.jpg</code></span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Right 1: Asif Ali Zardari -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Top Right #1 (Asif Ali Zardari)</label>
                                <input type="text" name="leader_right_1_name" class="admin-input mb-2" value="{{ old('leader_right_1_name', $settings['home.hero.leader_right_1_name'] ?? 'Asif Ali Zardari') }}" placeholder="Leader Name">
                                <input type="file" name="leader_right_1_file" class="form-control form-control-sm" accept="image/*" data-preview="leaderRight1Preview">
                                <input type="hidden" name="leader_right_1" value="{{ $settings['home.hero.leader_right_1'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderRight1Preview" src="{{ media_asset($settings['home.hero.leader_right_1'] ?? 'Assets/images/hero/asif-ali-zardari.jpg') }}" class="admin-img-preview rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="Top Right 1">
                                    <span class="text-muted small">Default: <code>Assets/images/hero/asif-ali-zardari.jpg</code></span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Right 2: Bakhtawar Bhutto Zardari -->
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label class="admin-label">Top Right #2 (Bakhtawar Bhutto Zardari)</label>
                                <input type="text" name="leader_right_2_name" class="admin-input mb-2" value="{{ old('leader_right_2_name', $settings['home.hero.leader_right_2_name'] ?? 'Bakhtawar Bhutto Zardari') }}" placeholder="Leader Name">
                                <input type="file" name="leader_right_2_file" class="form-control form-control-sm" accept="image/*" data-preview="leaderRight2Preview">
                                <input type="hidden" name="leader_right_2" value="{{ $settings['home.hero.leader_right_2'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="leaderRight2Preview" src="{{ media_asset($settings['home.hero.leader_right_2'] ?? 'Assets/images/hero/bakhtawar-bhutto-zardari.jpg') }}" class="admin-img-preview rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" alt="Top Right 2">
                                    <span class="text-muted small">Default: <code>Assets/images/hero/bakhtawar-bhutto-zardari.jpg</code></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Hero Changes</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
