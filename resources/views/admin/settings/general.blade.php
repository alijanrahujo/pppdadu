@extends('layouts.admin', [
    'title' => 'General & Social Settings',
    'pageTitle' => 'Site &amp; Social Media Settings'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.settings.general.update') }}" method="POST">
            @csrf

            <!-- Site Identity -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-sliders"></i> Site Identity</h2>
                    <span class="text-muted small">Website titles and branding names</span>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="site_title" class="admin-label">Browser Window Title <span class="required">*</span></label>
                                <input type="text" id="site_title" name="site_title" class="admin-input" value="{{ old('site_title', $settings['site.title'] ?? 'Pakistan Peoples Party | District Dadu') }}" required>
                                <div class="admin-help">Appears in browser tabs and search engine results.</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="site_name" class="admin-label">Party Name <span class="required">*</span></label>
                                <input type="text" id="site_name" name="site_name" class="admin-input" value="{{ old('site_name', $settings['site.name'] ?? 'Pakistan Peoples Party') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="site_district" class="admin-label">District Subtitle <span class="required">*</span></label>
                                <input type="text" id="site_district" name="site_district" class="admin-input" value="{{ old('site_district', $settings['site.district'] ?? 'District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="site_tagline" class="admin-label">Party Tagline / Motto</label>
                                <input type="text" id="site_tagline" name="site_tagline" class="admin-input" value="{{ old('site_tagline', $settings['site.tagline'] ?? 'Committed to democracy, social justice and the welfare of the people.') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-address-book"></i> Official Contact Info</h2>
                    <span class="text-muted small">Publicly displayed in website footer &amp; contact page</span>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="site_phone" class="admin-label">Contact Phone / WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-phone"></i></span>
                                    <input type="text" id="site_phone" name="site_phone" class="admin-input" value="{{ old('site_phone', $settings['site.phone'] ?? '+92 300 1234567') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="site_email" class="admin-label">Official Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" id="site_email" name="site_email" class="admin-input" value="{{ old('site_email', $settings['site.email'] ?? 'info@pppdadu.com') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="site_address" class="admin-label">Office Postal Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-location-dot"></i></span>
                                    <input type="text" id="site_address" name="site_address" class="admin-input" value="{{ old('site_address', $settings['site.address'] ?? 'District Office Pakistan Peoples Party, Dadu, Sindh, Pakistan') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Channels -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-share-nodes"></i> Social Media Links</h2>
                    <span class="text-muted small">Hero section and footer social icons</span>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="site_facebook" class="admin-label">Facebook Page URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-facebook-f text-primary"></i></span>
                                    <input type="url" id="site_facebook" name="site_facebook" class="admin-input" value="{{ old('site_facebook', $settings['site.facebook'] ?? '') }}" placeholder="https://facebook.com/...">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="site_twitter" class="admin-label">Twitter / X URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-x-twitter text-dark"></i></span>
                                    <input type="url" id="site_twitter" name="site_twitter" class="admin-input" value="{{ old('site_twitter', $settings['site.twitter'] ?? '') }}" placeholder="https://x.com/...">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="site_youtube" class="admin-label">YouTube Channel URL</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-youtube text-danger"></i></span>
                                    <input type="url" id="site_youtube" name="site_youtube" class="admin-input" value="{{ old('site_youtube', $settings['site.youtube'] ?? '') }}" placeholder="https://youtube.com/...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Settings</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
