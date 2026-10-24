@extends('layouts.admin', [
    'title' => ($blog->exists ? 'Edit Blog Post' : 'Create Blog Post'),
    'pageTitle' => ($blog->exists ? 'Media • Edit Article #' . $blog->id : 'Media • Create New Article')
])

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame {
        border: 1px solid var(--admin-border, #d5e2d8) !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .note-editor.note-frame .note-toolbar {
        background-color: #f7faf7 !important;
        border-bottom: 1px solid var(--admin-border, #d5e2d8) !important;
        padding: 8px 10px !important;
    }
    .note-editor.note-frame .note-btn {
        background: #ffffff !important;
        border: 1px solid #d5e2d8 !important;
        color: #2e3e33 !important;
        border-radius: 4px !important;
        padding: 5px 9px !important;
        font-size: 13px !important;
    }
    .note-editor.note-frame .note-btn:hover {
        background: #eef4f0 !important;
        color: var(--admin-green, #0b603d) !important;
        border-color: var(--admin-green, #0b603d) !important;
    }
    .note-editor.note-frame .note-btn.active {
        background: #0b603d !important;
        color: #ffffff !important;
        border-color: #0b603d !important;
    }
    .note-editor.note-frame .note-statusbar {
        background-color: #f9fbf9 !important;
        border-top: 1px solid var(--admin-border, #d5e2d8) !important;
    }
    .note-editable {
        background: #ffffff !important;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        font-size: 15px !important;
        line-height: 1.7 !important;
        color: #212529 !important;
        min-height: 320px;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ $blog->exists ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($blog->exists)
                @method('PUT')
                <input type="hidden" name="slug" value="{{ $blog->slug }}">
                <input type="hidden" name="image" value="{{ $blog->image }}">
            @endif

            {{-- Top Action Bar --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to All Articles
                </a>
                <div class="d-flex gap-2">
                    @if ($blog->exists)
                        <a href="{{ route('pages.blogs.show', $blog->slug) }}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fa-solid fa-eye me-1"></i> View Live
                        </a>
                    @endif
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i> {{ $blog->exists ? 'Save Changes' : 'Publish Article' }}
                    </button>
                </div>
            </div>

            {{-- Main Content Card --}}
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title">
                        <i class="fa-solid fa-newspaper text-success"></i>
                        {{ $blog->exists ? 'Edit Article Details' : 'Article Details' }}
                    </h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Article Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" style="height: 42px; font-size: 15px; font-weight: 600;" value="{{ old('title', $blog->title) }}" placeholder="e.g. Transforming Rural Infrastructure Across District Dadu" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="category" class="admin-label">Category <span class="required">*</span></label>
                                <select id="category" name="category" class="admin-select" style="height: 42px; font-size: 14px;" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $blog->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="excerpt" class="admin-label">Short Summary / Excerpt</label>
                                <textarea id="excerpt" name="excerpt" class="admin-textarea" rows="2" placeholder="Brief 1-2 sentence preview for cards and search engines...">{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="content" class="admin-label">Full Article Content <span class="required">*</span></label>
                                <textarea id="content" name="content" class="admin-textarea" rows="14" placeholder="Write full article content...">{{ old('content', $blog->content) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media Uploads Card (Photos & Videos) --}}
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <div>
                        <h2 class="admin-card-title text-success">
                            <i class="fa-solid fa-photo-film"></i>
                            Media Uploads
                        </h2>
                        <span class="text-muted small">Upload cover photo, attach video stories, and add photo gallery</span>
                    </div>
                </div>
                <div class="admin-card-body">
                    <div class="row g-4">
                        {{-- 1. Featured Cover Photo --}}
                        <div class="col-lg-6">
                            <div class="p-3 bg-light bg-opacity-75 rounded-3 border h-100">
                                <h5 class="fw-bold fs-6 mb-3 text-dark">
                                    <i class="fa-regular fa-image text-primary me-2"></i>1. Featured Cover Photo
                                </h5>

                                @if ($blog->exists && !empty($blog->image))
                                    <div class="mb-3 p-2 bg-white rounded text-center border">
                                        <img src="{{ $blog->image_url }}" alt="Current cover" class="img-fluid rounded mb-2 shadow-sm" style="max-height: 150px; object-fit: cover;">
                                        <div class="small text-muted text-truncate">Current Cover: <code>{{ $blog->image }}</code></div>
                                    </div>
                                @endif

                                <div class="admin-form-group">
                                    <label for="image_file" class="admin-label">Upload Cover Photo</label>
                                    <input type="file" id="image_file" name="image_file" class="form-control" accept="image/*">
                                    <small class="text-muted mt-1 d-block">Recommended size: 1200x800px (JPG, PNG, WebP up to 10MB).</small>
                                </div>
                            </div>
                        </div>

                        {{-- 2. Video Upload or Video URL --}}
                        <div class="col-lg-6">
                            <div class="p-3 bg-light bg-opacity-75 rounded-3 border h-100">
                                <h5 class="fw-bold fs-6 mb-3 text-dark">
                                    <i class="fa-solid fa-video text-danger me-2"></i>2. Video Story (File or Embed URL)
                                </h5>

                                @if ($blog->exists && $blog->has_video)
                                    <div class="mb-3 p-2 bg-white rounded border">
                                        @if (!empty($blog->video))
                                            <div class="mb-2">
                                                <video controls class="w-100 rounded" style="max-height: 140px; background: #000;">
                                                    <source src="{{ $blog->video_file_url }}">
                                                    Your browser does not support HTML5 video.
                                                </video>
                                                <small class="text-muted d-block mt-1 text-truncate">Uploaded file: <code>{{ $blog->video }}</code></small>
                                            </div>
                                        @elseif (!empty($blog->video_url))
                                            <div class="small text-muted mb-1">Embedded Video URL:</div>
                                            <a href="{{ $blog->video_url }}" target="_blank" class="small text-truncate d-block text-primary">{{ $blog->video_url }}</a>
                                        @endif

                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_video" value="1" id="remove_video">
                                            <label class="form-check-label text-danger small fw-bold" for="remove_video">
                                                Remove this video from post
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <div class="admin-form-group mb-3">
                                    <label for="video_file" class="admin-label">Upload Video File</label>
                                    <input type="file" id="video_file" name="video_file" class="form-control" accept="video/mp4,video/webm,video/ogg,video/quicktime">
                                    <small class="text-muted mt-1 d-block">MP4, WebM, MOV video up to 100MB.</small>
                                </div>

                                <div class="admin-form-group">
                                    <label for="video_url" class="admin-label">Or Embed Video Link (YouTube / Vimeo)</label>
                                    <input type="url" id="video_url" name="video_url" class="admin-input" value="{{ old('video_url', $blog->video_url) }}" placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/...">
                                </div>
                            </div>
                        </div>

                        {{-- 3. Additional Photo Gallery --}}
                        <div class="col-12">
                            <div class="p-3 bg-light bg-opacity-75 rounded-3 border">
                                <h5 class="fw-bold fs-6 mb-1 text-dark">
                                    <i class="fa-regular fa-images text-success me-2"></i>3. Additional Gallery Photos
                                </h5>
                                <p class="text-muted small mb-3">Upload multiple photos to create an interactive photo gallery inside this article.</p>

                                @if ($blog->exists && !empty($blog->photos) && count($blog->photos) > 0)
                                    <div class="mb-3">
                                        <div class="small fw-bold text-dark mb-2">Current Gallery Photos ({{ count($blog->photos) }}):</div>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($blog->photos_list as $photoUrl)
                                                <div class="position-relative border rounded p-1 bg-white shadow-sm" style="width: 100px;">
                                                    <img src="{{ $photoUrl }}" alt="Gallery photo" class="w-100 rounded" style="height: 65px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="admin-form-group mb-0">
                                    <label for="photo_files" class="admin-label">Select Multiple Photos</label>
                                    <input type="file" id="photo_files" name="photo_files[]" class="form-control" accept="image/*" multiple>
                                    <small class="text-muted mt-1 d-block">Hold Ctrl/Cmd while clicking to select multiple image files at once.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Actions Bar --}}
            <div class="d-flex justify-content-between align-items-center mb-5 p-3 bg-white border rounded shadow-sm">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to All Articles
                </a>
                <button type="submit" class="admin-btn admin-btn-primary px-4 py-2">
                    <i class="fa-solid fa-floppy-disk me-1"></i> {{ $blog->exists ? 'Save Changes' : 'Publish Article' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script>
    jQuery(function ($) {
        $('#content').summernote({
            placeholder: 'Write your full story here with formatting, headings, lists, quotes, and links...',
            tabsize: 2,
            height: 380,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Ensure Summernote HTML is synced into textarea on form submit, even from codeview mode
        $('form').on('submit', function () {
            const $content = $('#content');
            if ($content.summernote('codeview.isActivated')) {
                $content.summernote('codeview.deactivate');
            }
            $content.val($content.summernote('code'));
        });
    });
</script>
@endpush
