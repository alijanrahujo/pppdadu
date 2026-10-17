@extends('layouts.admin', [
    'title' => 'Homepage About Section',
    'pageTitle' => 'Homepage &bull; About PPP District Dadu'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.home.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Text & Headings -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-align-left"></i> About Section Text</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Badge <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $eyebrow ?? 'About PPP District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Section Heading <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $title ?? 'A Strong Voice for the people of Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="description" class="admin-label">Section Description <span class="required">*</span></label>
                                <textarea id="description" name="description" class="admin-textarea" rows="3" required>{{ old('description', $description ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label class="admin-label">Section Feature Photo</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="aboutPreview">
                                <input type="hidden" name="image" value="{{ $image ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="aboutPreview" src="{{ media_asset($image ?? 'Assets/images/ppp2-1024x568.jpg') }}" class="admin-img-preview" alt="About Image">
                                    <span class="text-muted small">Party gathering or district workers photo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Principles -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-list-check"></i> Key Principles / Highlights</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col-md-6">
                                <div class="admin-form-group">
                                    <label class="admin-label">Principle {{ $i + 1 }} <span class="required">*</span></label>
                                    <input type="text" name="principles[{{ $i }}]" class="admin-input" value="{{ old('principles.'.$i, $principles[$i] ?? '') }}" required placeholder="e.g. Democracy">
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- 4 Statistics Counter Items -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-chart-simple"></i> Counter Statistics</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        @for ($i = 0; $i < 4; $i++)
                            @php $stat = $stats[$i] ?? ['value' => '25+', 'label' => 'Years of service']; @endphp
                            <div class="col-md-6">
                                <div class="p-3 border rounded bg-light">
                                    <div class="row g-2">
                                        <div class="col-5">
                                            <label class="admin-label">Number / Value</label>
                                            <input type="text" name="stats[{{ $i }}][value]" class="admin-input" value="{{ old('stats.'.$i.'.value', $stat['value'] ?? '') }}" required placeholder="25+">
                                        </div>
                                        <div class="col-7">
                                            <label class="admin-label">Stat Label</label>
                                            <input type="text" name="stats[{{ $i }}][label]" class="admin-input" value="{{ old('stats.'.$i.'.label', $stat['label'] ?? '') }}" required placeholder="Years of service">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save About Section</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
