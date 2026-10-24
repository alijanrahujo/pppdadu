{{-- Single Blog Article View Template --}}
@php
    $blog = $page['blog'];
    $currentUrl = url()->current();
    $shareTitle = urlencode($blog->title);
    $shareUrl = urlencode($currentUrl);
@endphp

<article class="blog-detail-article">
    {{-- Breadcrumb Navigation --}}
    <nav aria-label="Breadcrumb" class="mb-4">
        <ol class="breadcrumb blog-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pages.blogs') }}">Blogs &amp; News</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($blog->title, 40) }}</li>
        </ol>
    </nav>

    {{-- Article Header --}}
    <header class="blog-post-header">
        <div class="blog-header-meta">
            <a href="{{ route('pages.blogs', ['category' => $blog->category]) }}" class="badge-category-link">
                {{ $blog->category }}
            </a>
            <span class="meta-separator">•</span>
            <span class="meta-item"><i class="fa-regular fa-calendar-check me-1"></i> {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
            <span class="meta-separator">•</span>
            <span class="meta-item"><i class="fa-regular fa-clock me-1"></i> {{ $blog->read_time }}</span>
            <span class="meta-separator">•</span>
            <span class="meta-item"><i class="fa-regular fa-eye me-1"></i> {{ number_format($blog->views_count) }} views</span>
        </div>

        <h1 class="blog-post-title">{{ $blog->title }}</h1>

        @if (!empty($blog->excerpt))
            <p class="blog-post-lead">{{ $blog->excerpt }}</p>
        @endif

        {{-- Action Bar & Social Share --}}
        <div class="blog-author-share-bar d-flex align-items-center justify-content-between">
            <div class="blog-published-meta text-muted small">
                <i class="fa-regular fa-calendar-check me-1"></i> Published on {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }} &bull; <i class="fa-regular fa-clock ms-1 me-1"></i> {{ $blog->read_time }}
            </div>

            <div class="share-buttons-group" aria-label="Share this article">
                <span class="share-label">Share:</span>
                <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="btn-share btn-share-whatsapp" title="Share on WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="btn-share btn-share-facebook" title="Share on Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="btn-share btn-share-x" title="Share on X (Twitter)">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <button type="button" class="btn-share btn-share-copy" title="Copy article link" onclick="navigator.clipboard.writeText(window.location.href); alert('Article link copied to clipboard!');">
                    <i class="fa-solid fa-link"></i>
                </button>
            </div>
        </div>
    </header>

    {{-- Featured Video or Image Banner --}}
    @if ($blog->has_video)
        <div class="blog-media-video-block my-4">
            @if (!empty($blog->video_file_url))
                <div class="video-player-wrap rounded-4 overflow-hidden shadow-sm bg-black">
                    <video controls playsinline poster="{{ $blog->image_url }}" class="w-100" style="max-height: 520px; object-fit: contain;">
                        <source src="{{ $blog->video_file_url }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="video-caption text-center text-muted small mt-2">
                    <i class="fa-solid fa-circle-play text-danger me-1"></i> Official Video Coverage &bull; Pakistan Peoples Party District Dadu
                </div>
            @elseif (!empty($blog->embed_video_url))
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
                    <iframe src="{{ $blog->embed_video_url }}" title="{{ $blog->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            @endif
        </div>
    @elseif (!empty($blog->image_url))
        <figure class="blog-featured-figure my-4">
            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded-4 shadow-sm" loading="eager">
        </figure>
    @endif

    {{-- Article Body Content --}}
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="blog-prose-content">
                {!! $blog->content !!}
            </div>

            {{-- Additional Photo Gallery --}}
            @if (!empty($blog->photos_list) && count($blog->photos_list) > 0)
                <section class="blog-photo-gallery-section my-5 pt-4 border-top">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fw-bold fs-5 mb-0">
                            <i class="fa-regular fa-images text-success me-2"></i>
                            Activity Photo Gallery ({{ count($blog->photos_list) }})
                        </h3>
                        <span class="text-muted small"><i class="fa-solid fa-expand me-1"></i> Click to enlarge</span>
                    </div>
                    <div class="row g-3 blog-gallery-grid">
                        @foreach ($blog->photos_list as $photoIdx => $pUrl)
                            <div class="col-6 col-md-4">
                                <a href="#" class="blog-gallery-thumb" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $photoIdx }}">
                                    <img src="{{ $pUrl }}" alt="Activity photo {{ $photoIdx + 1 }}" loading="lazy" class="img-fluid rounded-3">
                                    <span class="thumb-zoom-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                                </a>

                                <div class="modal fade" id="galleryModal{{ $photoIdx }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content bg-transparent border-0">
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-2">
                                                <img src="{{ $pUrl }}" alt="Enlarged gallery photo" class="img-fluid rounded-3 shadow-lg" style="max-height: 82vh;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Tags Cloud --}}
            @if (!empty($blog->tags) && is_array($blog->tags))
                <div class="blog-tags-wrapper mt-4 pt-3 border-top">
                    <span class="tags-label"><i class="fa-solid fa-tags me-1"></i> Tags:</span>
                    @foreach ($blog->tags as $tag)
                        <span class="blog-tag-pill">#{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Navigation to Back to Blogs --}}
            <div class="blog-navigation-footer mt-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('pages.blogs') }}" class="btn btn-outline-success">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to All Blogs
                </a>
                <a href="{{ route('pages.join') }}" class="btn btn-success">
                    <i class="fa-solid fa-user-plus me-1"></i> Join PPP Today
                </a>
            </div>
        </div>
    </div>

    {{-- Related Articles Section --}}
    @if (!empty($page['relatedPosts']) && $page['relatedPosts']->isNotEmpty())
        <section class="related-articles-section mt-5 pt-5 border-top" aria-label="Related Articles">
            <div class="section-header-compact text-center mb-4">
                <span class="eyebrow">Continue Reading</span>
                <h3 class="fw-bold">Related News &amp; Updates</h3>
            </div>
            <div class="row g-4">
                @foreach ($page['relatedPosts'] as $related)
                    <div class="col-md-4">
                        <article class="blog-card h-100">
                            <div class="blog-card-media">
                                <a href="{{ route('pages.blogs.show', $related->slug) }}" tabindex="-1" aria-hidden="true">
                                    <img src="{{ $related->image_url }}" alt="{{ $related->title }}" loading="lazy">
                                </a>
                                <span class="blog-category-tag">{{ $related->category }}</span>
                            </div>
                            <div class="blog-card-body">
                                <span class="meta-date text-muted small d-block mb-1">
                                    <i class="fa-regular fa-calendar-check me-1"></i>
                                    {{ $related->published_at ? $related->published_at->format('M d, Y') : $related->created_at->format('M d, Y') }}
                                </span>
                                <h4 class="blog-card-title fs-6">
                                    <a href="{{ route('pages.blogs.show', $related->slug) }}">{{ $related->title }}</a>
                                </h4>
                            </div>
                            <div class="blog-card-footer">
                                <span class="meta-read-time text-muted small"><i class="fa-regular fa-clock me-1"></i> {{ $related->read_time }}</span>
                                <a href="{{ route('pages.blogs.show', $related->slug) }}" class="blog-read-link">
                                    Read <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</article>
