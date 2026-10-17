@extends('layouts.admin', [
    'title' => 'Party Values Strip',
    'pageTitle' => 'Homepage &bull; Party Values Strip'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.home.values.update') }}" method="POST">
            @csrf

            <div class="admin-card">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-heart-pulse"></i> Party Core Values (Strip below Hero)</h2>
                        <div class="admin-card-subtitle">Values displayed horizontally across the screen below the video header.</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addValueBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Value Item
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="valuesContainer" class="admin-repeater-list">
                        @foreach ($values as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="admin-label">Title <span class="required">*</span></label>
                                        <input type="text" name="values[{{ $index }}][title]" class="admin-input" value="{{ $item['title'] ?? '' }}" required placeholder="e.g. Serving the people">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="admin-label">Subtitle / Description <span class="required">*</span></label>
                                        <input type="text" name="values[{{ $index }}][subtitle]" class="admin-input" value="{{ $item['subtitle'] ?? '' }}" required placeholder="e.g. Working for a better tomorrow">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">FontAwesome Icon</label>
                                        <input type="text" name="values[{{ $index }}][icon]" class="admin-input" value="{{ $item['icon'] ?? 'fa-people-group' }}" required placeholder="fa-people-group">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Badge Color</label>
                                        <select name="values[{{ $index }}][color]" class="admin-select">
                                            <option value="green" {{ ($item['color'] ?? '') === 'green' ? 'selected' : '' }}>Green</option>
                                            <option value="red" {{ ($item['color'] ?? '') === 'red' ? 'selected' : '' }}>Red</option>
                                            <option value="black" {{ ($item['color'] ?? '') === 'black' ? 'selected' : '' }}>Black</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Values Strip</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let valueIndex = {{ count($values) }};
    $('#addValueBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="admin-label">Title <span class="required">*</span></label>
                        <input type="text" name="values[${valueIndex}][title]" class="admin-input" required placeholder="Title">
                    </div>
                    <div class="col-md-4">
                        <label class="admin-label">Subtitle / Description <span class="required">*</span></label>
                        <input type="text" name="values[${valueIndex}][subtitle]" class="admin-input" required placeholder="Description">
                    </div>
                    <div class="col-md-2">
                        <label class="admin-label">FontAwesome Icon</label>
                        <input type="text" name="values[${valueIndex}][icon]" class="admin-input" value="fa-circle-check" required>
                    </div>
                    <div class="col-md-2">
                        <label class="admin-label">Badge Color</label>
                        <select name="values[${valueIndex}][color]" class="admin-select">
                            <option value="green" selected>Green</option>
                            <option value="red">Red</option>
                            <option value="black">Black</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
        $('#valuesContainer').append(tpl);
        valueIndex++;
    });
</script>
@endpush
