@extends('layouts.admin', [
    'title' => 'Join Page Content',
    'pageTitle' => 'Pages &bull; Join PPP (Online Membership) Page'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.pages.join.update') }}" method="POST">
            @csrf

            <!-- Header Text -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-address-card"></i> Join Page Header</h2>
                        <div class="admin-card-subtitle">Title and introduction above the online membership form</div>
                    </div>
                    <a href="{{ route('admin.submissions.memberships') }}" class="btn btn-sm btn-outline-success">
                        <i class="fa-solid fa-id-card-clip me-1"></i> View Membership Applications
                    </a>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Page Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['join.title'] ?? 'Join (Online Membership)') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Kicker <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $settings['join.eyebrow'] ?? 'Be a part of change') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="subtitle" class="admin-label">Subtitle / Message <span class="required">*</span></label>
                                <textarea id="subtitle" name="subtitle" class="admin-textarea" rows="3" required>{{ old('subtitle', $settings['join.subtitle'] ?? 'Become a part of Pakistan Peoples Party District Dadu and contribute to the progress, peace and prosperity of our society.') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Principles -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-star"></i> Why Join Us (Feature Highlights)</h2>
                        <div class="admin-card-subtitle">Displayed alongside the membership wizard</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addPrincipleBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Item
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="principlesContainer" class="admin-repeater-list">
                        @php $principles = $settings['join.principles'] ?? []; @endphp
                        @foreach ($principles as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <label class="admin-label">Title <span class="required">*</span></label>
                                        <input type="text" name="principles[{{ $index }}][title]" class="admin-input" value="{{ $item['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Description <span class="required">*</span></label>
                                        <input type="text" name="principles[{{ $index }}][description]" class="admin-input" value="{{ $item['description'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon</label>
                                        <input type="text" name="principles[{{ $index }}][icon]" class="admin-input" value="{{ $item['icon'] ?? 'fa-people-group' }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Join Page Content</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let pIndex = {{ count($principles) }};
    $('#addPrincipleBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="admin-label">Title <span class="required">*</span></label>
                        <input type="text" name="principles[${pIndex}][title]" class="admin-input" required placeholder="Title">
                    </div>
                    <div class="col-md-5">
                        <label class="admin-label">Description <span class="required">*</span></label>
                        <input type="text" name="principles[${pIndex}][description]" class="admin-input" required placeholder="Description">
                    </div>
                    <div class="col-md-2">
                        <label class="admin-label">Icon</label>
                        <input type="text" name="principles[${pIndex}][icon]" class="admin-input" value="fa-check" required>
                    </div>
                </div>
            </div>
        `;
        $('#principlesContainer').append(tpl);
        pIndex++;
    });
</script>
@endpush
