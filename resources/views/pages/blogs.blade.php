{{-- Blogs & News Page Template --}}
<div class="blogs-page">
    <header class="blogs-page-heading">
        <nav aria-label="Breadcrumb" class="mb-3">
            <ol class="breadcrumb blogs-breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blogs &amp; News</li>
            </ol>
        </nav>
        <span class="eyebrow">Stay Connected &amp; Informed</span>
        <h1>Blogs <span>&amp; News</span></h1>
        <p>{{ $page['subtitle'] ?? 'Official updates, developmental milestones, press statements and stories from Pakistan Peoples Party District Dadu.' }}</p>
    </header>

    {{-- Filter & Search Bar --}}
    <div class="blogs-controls-bar mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-lg-5">
                <form action="{{ route('pages.blogs') }}" method="GET" class="blogs-search-form">
                    @if (!empty($page['currentCategory']) && $page['currentCategory'] !== 'all')
                        <input type="hidden" name="category" value="{{ $page['currentCategory'] }}">
                    @endif
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search news, statements, developments..." value="{{ $page['search'] ?? '' }}">
                        @if (!empty($page['search']))
                            <a href="{{ route('pages.blogs', ['category' => $page['currentCategory'] ?? 'all']) }}" class="btn btn-outline-secondary" title="Clear search">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif
                        <button class="btn btn-search-submit" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-7">
                <nav class="blogs-category-pills" aria-label="Filter blog posts by category">
                    <a href="{{ route('pages.blogs', array_filter(['search' => $page['search'] ?? null])) }}" class="category-pill {{ empty($page['currentCategory']) || $page['currentCategory'] === 'all' ? 'active' : '' }}">
                        All Updates
                    </a>
                    @foreach ($page['categories'] as $cat)
                        <a href="{{ route('pages.blogs', array_filter(['category' => $cat, 'search' => $page['search'] ?? null])) }}" class="category-pill {{ ($page['currentCategory'] ?? '') === $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
    </div>

    {{-- Featured Story (displayed on first page when not searching) --}}
    @if (empty($page['search']) && (empty($page['currentCategory']) || $page['currentCategory'] === 'all') && !empty($page['featuredBlog']))
        @php $featured = $page['featuredBlog']; @endphp
        <section class="featured-blog-card mb-5" aria-label="Featured Story">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-7">
                    <div class="featured-image-wrap">
                        <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" loading="lazy">
                        <span class="featured-badge"><i class="fa-solid fa-star me-1"></i> Featured Story</span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="featured-content">
                        <div class="featured-meta">
                            <span class="badge-category">{{ $featured->category }}</span>
                            <span class="meta-item"><i class="fa-regular fa-calendar me-1"></i> {{ $featured->published_at ? $featured->published_at->format('M d, Y') : $featured->created_at->format('M d, Y') }}</span>
                            <span class="meta-item"><i class="fa-regular fa-clock me-1"></i> {{ $featured->read_time }}</span>
                        </div>
                        <h2 class="featured-title">
                            <a href="{{ route('pages.blogs.show', $featured->slug) }}">{{ $featured->title }}</a>
                        </h2>
                        <p class="featured-excerpt">{{ $featured->excerpt }}</p>
                        <div class="featured-footer d-flex align-items-center justify-content-between">
                            <span class="featured-meta-note text-muted small">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> Official Party Update
                            </span>
                            <a href="{{ route('pages.blogs.show', $featured->slug) }}" class="btn-read-story">
                                Read Full Story <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Main Articles Grid --}}
    <section class="blogs-grid-section" aria-label="News and Blog Articles">
        @if ($page['blogs']->isEmpty())
            <div class="blogs-empty-state text-center p-5">
                <div class="empty-icon mb-3">
                    <i class="fa-solid fa-newspaper fa-3x text-muted"></i>
                </div>
                <h3>No articles found</h3>
                <p class="text-muted">No posts match your current search query or category filter.</p>
                <a href="{{ route('pages.blogs') }}" class="btn btn-outline-success mt-2">
                    <i class="fa-solid fa-rotate-left me-1"></i> View All Articles
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($page['blogs'] as $blog)
                    <div class="col-md-6 col-lg-4">
                        <article class="blog-card h-100">
                            <div class="blog-card-media">
                                <a href="{{ route('pages.blogs.show', $blog->slug) }}" tabindex="-1" aria-hidden="true">
                                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" loading="lazy">
                                </a>
                                <span class="blog-category-tag">{{ $blog->category }}</span>
                                @if ($blog->has_video)
                                    <span class="blog-media-type-badge video-badge"><i class="fa-solid fa-play me-1"></i> Video</span>
                                @elseif (!empty($blog->photos) && count($blog->photos) > 0)
                                    <span class="blog-media-type-badge gallery-badge"><i class="fa-regular fa-images me-1"></i> Photos</span>
                                @endif
                            </div>
                            <div class="blog-card-body">
                                <div class="blog-meta-row">
                                    <span class="meta-date">
                                        <i class="fa-regular fa-calendar-check me-1"></i>
                                        {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="meta-read-time">
                                        <i class="fa-regular fa-clock me-1"></i>
                                        {{ $blog->read_time }}
                                    </span>
                                </div>
                                <h3 class="blog-card-title">
                                    <a href="{{ route('pages.blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="blog-card-excerpt">{{ \Illuminate\Support\Str::limit($blog->excerpt, 125) }}</p>
                            </div>
                            <div class="blog-card-footer d-flex align-items-center justify-content-between">
                                <span class="blog-footer-meta text-muted small">
                                    <i class="fa-regular fa-clock me-1"></i> {{ $blog->read_time }}
                                </span>
                                <a href="{{ route('pages.blogs.show', $blog->slug) }}" class="blog-read-link" aria-label="Read full article: {{ $blog->title }}">
                                    Read Article <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            @if ($page['blogs']->hasPages())
                <div class="blogs-pagination-wrap mt-5 d-flex justify-content-center">
                    {{ $page['blogs']->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </section>

    {{-- Bottom Community Banner --}}
    <section class="blogs-cta-banner mt-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="cta-eyebrow">Join the Movement</span>
                <h2>Be Part of District Dadu’s Progressive Future</h2>
                <p>Stay informed, participate in grassroots community welfare, and stand together for democracy and social justice.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('pages.join') }}" class="btn btn-join-cta me-2 mb-2 mb-sm-0">
                    <i class="fa-solid fa-user-plus me-1"></i> Join PPP Dadu
                </a>
                <a href="{{ route('pages.contact') }}" class="btn btn-contact-cta">
                    <i class="fa-solid fa-paper-plane me-1"></i> Send Suggestions
                </a>
            </div>
        </div>
    </section>
</div>
