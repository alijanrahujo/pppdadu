@extends('layouts.admin', [
    'title' => 'Municipal Bodies Content',
    'pageTitle' => 'Pages &bull; Municipal &amp; Town Bodies Content'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.pages.municipal-bodies.update') }}" method="POST">
            @csrf

            <!-- Header Text -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-city"></i> Page Headings &amp; Overview</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Page Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['municipal_bodies.title'] ?? 'Municipal & Town Bodies') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Kicker <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $settings['municipal_bodies.eyebrow'] ?? 'Local organization') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="subtitle" class="admin-label">Subtitle Heading <span class="required">*</span></label>
                                <input type="text" id="subtitle" name="subtitle" class="admin-input" value="{{ old('subtitle', $settings['municipal_bodies.subtitle'] ?? 'Working for stronger communities') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="description" class="admin-label">Description <span class="required">*</span></label>
                                <textarea id="description" name="description" class="admin-textarea" rows="3" required>{{ old('description', $settings['municipal_bodies.description'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-chart-pie"></i> Local Statistics Bar</h2>
                        <div class="admin-card-subtitle">Elected members, municipal committees, projects, and citizens served</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addStatBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Statistic
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="statsContainer" class="admin-repeater-list">
                        @php $statistics = $settings['municipal_bodies.statistics'] ?? []; @endphp
                        @foreach ($statistics as $index => $stat)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="admin-label">Number / Count <span class="required">*</span></label>
                                        <input type="text" name="statistics[{{ $index }}][value]" class="admin-input" value="{{ $stat['value'] ?? '' }}" required placeholder="e.g. 50+">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="admin-label">Label <span class="required">*</span></label>
                                        <input type="text" name="statistics[{{ $index }}][label]" class="admin-input" value="{{ $stat['label'] ?? '' }}" required placeholder="e.g. Elected Members">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="admin-label">FontAwesome Icon</label>
                                        <input type="text" name="statistics[{{ $index }}][icon]" class="admin-input" value="{{ $stat['icon'] ?? 'fa-landmark' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon Color</label>
                                        <select name="statistics[{{ $index }}][color]" class="admin-select">
                                            <option value="red" {{ ($stat['color'] ?? '') === 'red' ? 'selected' : '' }}>Red</option>
                                            <option value="green" {{ ($stat['color'] ?? '') === 'green' ? 'selected' : '' }}>Green</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Key Priorities -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-bullseye"></i> Key Priorities</h2>
                        <div class="admin-card-subtitle">Areas of focus for local town and municipal bodies</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addPriorityBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Priority
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="prioritiesContainer" class="admin-repeater-list">
                        @php $priorities = $settings['municipal_bodies.priorities'] ?? []; @endphp
                        @foreach ($priorities as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <label class="admin-label">Priority Title <span class="required">*</span></label>
                                        <input type="text" name="priorities[{{ $index }}][title]" class="admin-input" value="{{ $item['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Description <span class="required">*</span></label>
                                        <input type="text" name="priorities[{{ $index }}][description]" class="admin-input" value="{{ $item['description'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon</label>
                                        <input type="text" name="priorities[{{ $index }}][icon]" class="admin-input" value="{{ $item['icon'] ?? 'fa-landmark' }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Municipal Bodies Content</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let sIndex = {{ count($statistics) }};
    $('#addStatBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="admin-label">Number / Count <span class="required">*</span></label>
                        <input type="text" name="statistics[${sIndex}][value]" class="admin-input" required placeholder="50+">
                    </div>
                    <div class="col-md-4">
                        <label class="admin-label">Label <span class="required">*</span></label>
                        <input type="text" name="statistics[${sIndex}][label]" class="admin-input" required placeholder="Label">
                    </div>
                    <div class="col-md-3">
                        <label class="admin-label">FontAwesome Icon</label>
                        <input type="text" name="statistics[${sIndex}][icon]" class="admin-input" value="fa-landmark" required>
                    </div>
                    <div class="col-md-2">
                        <label class="admin-label">Icon Color</label>
                        <select name="statistics[${sIndex}][color]" class="admin-select">
                            <option value="red">Red</option>
                            <option value="green" selected>Green</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
        $('#statsContainer').append(tpl);
        sIndex++;
    });

    let prIndex = {{ count($priorities) }};
    $('#addPriorityBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="admin-label">Priority Title <span class="required">*</span></label>
                        <input type="text" name="priorities[${prIndex}][title]" class="admin-input" required placeholder="Title">
                    </div>
                    <div class="col-md-5">
                        <label class="admin-label">Description <span class="required">*</span></label>
                        <input type="text" name="priorities[${prIndex}][description]" class="admin-input" required placeholder="Description">
                    </div>
                    <div class="col-md-2">
                        <label class="admin-label">Icon</label>
                        <input type="text" name="priorities[${prIndex}][icon]" class="admin-input" value="fa-circle-check" required>
                    </div>
                </div>
            </div>
        `;
        $('#prioritiesContainer').append(tpl);
        prIndex++;
    });
</script>
@endpush
