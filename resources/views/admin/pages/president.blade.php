@extends('layouts.admin', [
    'title' => 'About President Content',
    'pageTitle' => 'Pages &bull; About Our President (Pir Mujeeb-ul-Haq)'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.pages.president.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Header & Identity -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-user-tie"></i> President Identity &amp; Bio</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Page Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['president.title'] ?? 'About Our President') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Kicker <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $settings['president.eyebrow'] ?? 'District leadership') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="name" class="admin-label">President Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" class="admin-input" value="{{ old('name', $settings['president.name'] ?? 'Barrister Pir Mujeeb-ul-Haq') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="role" class="admin-label">Official Designation <span class="required">*</span></label>
                                <input type="text" id="role" name="role" class="admin-input" value="{{ old('role', $settings['president.role'] ?? 'MPA and District President, Pakistan Peoples Party District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label class="admin-label">President Official Photo</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="presidentPreview">
                                <input type="hidden" name="image" value="{{ $settings['president.image'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="presidentPreview" src="{{ media_asset($settings['president.image'] ?? 'Assets/images/mujeepir-1024x1024.png') }}" class="admin-img-preview" alt="President Photo">
                                    <span class="text-muted small">Default: <code>mujeepir-1024x1024.png</code></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="description" class="admin-label">Full Biography / Statement <span class="required">*</span></label>
                                <textarea id="description" name="description" class="admin-textarea" rows="4" required>{{ old('description', $settings['president.description'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission, Vision & Quote -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-bullseye"></i> Mission, Vision &amp; Quote</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="quote" class="admin-label">President Quote / Motto <span class="required">*</span></label>
                                <textarea id="quote" name="quote" class="admin-textarea" rows="2" required>{{ old('quote', $settings['president.quote'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="mission" class="admin-label">Our Mission <span class="required">*</span></label>
                                <textarea id="mission" name="mission" class="admin-textarea" rows="3" required>{{ old('mission', $settings['president.mission'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="vision" class="admin-label">Our Vision <span class="required">*</span></label>
                                <textarea id="vision" name="vision" class="admin-textarea" rows="3" required>{{ old('vision', $settings['president.vision'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Guiding Principles -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-scale-balanced"></i> Guiding Principles (4 Items)</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        @php $principles = $settings['president.principles'] ?? ["Advocate for People's Rights", 'Development Focused', 'Democracy & Justice', 'Community First']; @endphp
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col-md-6">
                                <div class="admin-form-group">
                                    <label class="admin-label">Principle {{ $i + 1 }} <span class="required">*</span></label>
                                    <input type="text" name="principles[{{ $i }}]" class="admin-input" value="{{ old('principles.'.$i, $principles[$i] ?? '') }}" required>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Key Achievements -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-trophy"></i> Key Achievements</h2>
                        <div class="admin-card-subtitle">Major initiatives and development accomplishments</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addAchievementBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Achievement
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="achievementsContainer" class="admin-repeater-list">
                        @php $achievements = $settings['president.achievements'] ?? []; @endphp
                        @foreach ($achievements as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <label class="admin-label">Title <span class="required">*</span></label>
                                        <input type="text" name="achievements[{{ $index }}][title]" class="admin-input" value="{{ $item['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Description <span class="required">*</span></label>
                                        <input type="text" name="achievements[{{ $index }}][description]" class="admin-input" value="{{ $item['description'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon</label>
                                        <input type="text" name="achievements[{{ $index }}][icon]" class="admin-input" value="{{ $item['icon'] ?? 'fa-road' }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Political & Public Service Journey -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-timeline"></i> Service Journey Timeline</h2>
                        <div class="admin-card-subtitle">Milestones across public service career</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addJourneyBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Milestone
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="journeyContainer" class="admin-repeater-list">
                        @php $journey = $settings['president.journey'] ?? []; @endphp
                        @foreach ($journey as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="admin-label">Period / Years <span class="required">*</span></label>
                                        <input type="text" name="journey[{{ $index }}][period]" class="admin-input" value="{{ $item['period'] ?? '' }}" required placeholder="e.g. 2010–2015">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="admin-label">Description <span class="required">*</span></label>
                                        <input type="text" name="journey[{{ $index }}][description]" class="admin-input" value="{{ $item['description'] ?? '' }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save President Page Content</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let achIndex = {{ count($achievements) }};
    $('#addAchievementBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="admin-label">Title <span class="required">*</span></label>
                        <input type="text" name="achievements[${achIndex}][title]" class="admin-input" required placeholder="Achievement Title">
                    </div>
                    <div class="col-md-5">
                        <label class="admin-label">Description <span class="required">*</span></label>
                        <input type="text" name="achievements[${achIndex}][description]" class="admin-input" required placeholder="Description of project">
                    </div>
                    <div class="col-md-2">
                        <label class="admin-label">Icon</label>
                        <input type="text" name="achievements[${achIndex}][icon]" class="admin-input" value="fa-check-circle" required>
                    </div>
                </div>
            </div>
        `;
        $('#achievementsContainer').append(tpl);
        achIndex++;
    });

    let journeyIndex = {{ count($journey) }};
    $('#addJourneyBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="admin-label">Period / Years <span class="required">*</span></label>
                        <input type="text" name="journey[${journeyIndex}][period]" class="admin-input" required placeholder="e.g. 2020–Present">
                    </div>
                    <div class="col-md-8">
                        <label class="admin-label">Description <span class="required">*</span></label>
                        <input type="text" name="journey[${journeyIndex}][description]" class="admin-input" required placeholder="Milestone description">
                    </div>
                </div>
            </div>
        `;
        $('#journeyContainer').append(tpl);
        journeyIndex++;
    });
</script>
@endpush
