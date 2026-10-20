@extends('layouts.admin', [
    'title' => 'About General Secretary Content',
    'pageTitle' => 'Pages &bull; About General Secretary (Syed Naveed Ahmed Shah)'
])

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame {
        border: 1px solid var(--admin-border);
        border-radius: 6px;
        background: #ffffff;
    }
    .note-editor.note-frame .note-toolbar {
        background: #f8faf9;
        border-bottom: 1px solid var(--admin-border);
        border-radius: 6px 6px 0 0;
        padding: 6px 8px;
    }
    .note-editor.note-frame .note-statusbar {
        background: #f8faf9;
        border-top: 1px solid var(--admin-border);
    }
    .note-editor.note-frame .note-editing-area .note-editable {
        min-height: 160px;
        font-size: 14px;
        line-height: 1.6;
        color: var(--admin-text-main);
    }
    .note-btn {
        background: #ffffff;
        border: 1px solid #d5e2d8;
        color: var(--admin-text-main);
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .note-btn:hover {
        background: #f0f4f1;
    }
    .note-btn.active {
        background: var(--admin-green);
        color: #ffffff;
        border-color: var(--admin-green);
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.pages.general-secretary.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Header & Identity -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-user-pen"></i> General Secretary Identity &amp; Bio</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Page Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['general_secretary.title'] ?? 'About Our General Secretary') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Kicker <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $settings['general_secretary.eyebrow'] ?? 'District leadership') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="name" class="admin-label">Leader Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" class="admin-input" value="{{ old('name', $settings['general_secretary.name'] ?? 'Syed Naveed Ahmed Shah') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="role" class="admin-label">Official Designation <span class="required">*</span></label>
                                <input type="text" id="role" name="role" class="admin-input" value="{{ old('role', $settings['general_secretary.role'] ?? 'General Secretary, Pakistan Peoples Party District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label class="admin-label">Official Portrait Photo</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="gsPreview">
                                <input type="hidden" name="image" value="{{ $settings['general_secretary.image'] ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="gsPreview" src="{{ media_asset($settings['general_secretary.image'] ?? 'Assets/images/gc-1024x1024.png') }}" class="admin-img-preview" alt="General Secretary Photo">
                                    <span class="text-muted small">Default: <code>gc-1024x1024.png</code></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="description" class="admin-label">Biography / Description (Text Editor) <span class="required">*</span></label>
                                <textarea id="description" name="description" class="admin-textarea rich-editor" rows="6" required>{{ old('description', $settings['general_secretary.description'] ?? '') }}</textarea>
                                <div class="admin-help mt-2 text-muted small">
                                    <i class="fa-solid fa-circle-info me-1"></i> Use this rich text editor to format biography paragraphs, bold text, lists, or links.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="quote" class="admin-label">Leader Quote / Motto <span class="required">*</span></label>
                                <textarea id="quote" name="quote" class="admin-textarea" rows="2" required>{{ old('quote', $settings['general_secretary.quote'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Secretary Statement Box (Impact Section) -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-quote-left"></i> General Secretary Statement Box (Impact Section)</h2>
                        <div class="admin-card-subtitle">Quote, citation, and designation displayed in the hero statement section</div>
                    </div>
                </div>
                <div class="admin-card-body">
                    <div class="admin-form-group mb-0">
                        <label for="statement" class="admin-label">Statement Box Content (Text Editor) <span class="required">*</span></label>
                        <textarea id="statement" name="statement" class="admin-textarea rich-editor" rows="6">{{ old('statement', $settings['general_secretary.statement'] ?? ("<p>“" . ($settings['general_secretary.quote'] ?? 'Our strength lies in our unity and our connection with the people. Together, we can build a stronger, progressive and prosperous Dadu.') . "”</p>\n<cite>- " . ($settings['general_secretary.name'] ?? 'Syed Naveed Ahmed Shah') . "</cite>\n<span>" . ($settings['general_secretary.role'] ?? 'General Secretary, PPP District Dadu') . "</span>")) }}</textarea>
                        <div class="admin-help mt-2 text-muted small">
                            <i class="fa-solid fa-circle-info me-1"></i> Edit quote paragraph, citation name, and designation freely with the text editor. You can click the Code View button (<code>&lt;/&gt;</code>) in the editor toolbar to inspect or adjust HTML tags (e.g. <code>&lt;cite&gt;</code>, <code>&lt;span&gt;</code>).
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Principles -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-list-check"></i> Key Principles (4 Items)</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        @php $principles = $settings['general_secretary.principles'] ?? ['Strong Leadership', 'Party Organization', 'Public Service', 'Youth Empowerment']; @endphp
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

            <!-- Commitments -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-handshake"></i> Core Commitments</h2>
                        <div class="admin-card-subtitle">Values and commitments to District Dadu citizens</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addCommitmentBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Commitment
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="commitmentsContainer" class="admin-repeater-list">
                        @php $commitments = $settings['general_secretary.commitments'] ?? []; @endphp
                        @foreach ($commitments as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <label class="admin-label">Title <span class="required">*</span></label>
                                        <input type="text" name="commitments[{{ $index }}][title]" class="admin-input" value="{{ $item['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Description <span class="required">*</span></label>
                                        <input type="text" name="commitments[{{ $index }}][description]" class="admin-input" value="{{ $item['description'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon</label>
                                        <input type="text" name="commitments[{{ $index }}][icon]" class="admin-input" value="{{ $item['icon'] ?? 'fa-people-group' }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save General Secretary Content</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script>
    jQuery(function ($) {
        $('#description').summernote({
            placeholder: 'Enter full biography and description...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('#statement').summernote({
            placeholder: 'Enter quote, citation, and designation...',
            tabsize: 2,
            height: 180,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Ensure Summernote code is copied into textareas on form submit, even from codeview mode
        $('form').on('submit', function () {
            $('#statement, #description').each(function () {
                const $el = $(this);
                if ($el.summernote('codeview.isActivated')) {
                    $el.summernote('codeview.deactivate');
                }
                $el.val($el.summernote('code'));
            });
        });

        let comIndex = {{ count($commitments) }};
        $('#addCommitmentBtn').on('click', function () {
            const tpl = `
                <div class="admin-repeater-item">
                    <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="admin-label">Title <span class="required">*</span></label>
                            <input type="text" name="commitments[${comIndex}][title]" class="admin-input" required placeholder="Title">
                        </div>
                        <div class="col-md-5">
                            <label class="admin-label">Description <span class="required">*</span></label>
                            <input type="text" name="commitments[${comIndex}][description]" class="admin-input" required placeholder="Description">
                        </div>
                        <div class="col-md-2">
                            <label class="admin-label">Icon</label>
                            <input type="text" name="commitments[${comIndex}][icon]" class="admin-input" value="fa-flag" required>
                        </div>
                    </div>
                </div>
            `;
            $('#commitmentsContainer').append(tpl);
            comIndex++;
        });
    });
</script>
@endpush
