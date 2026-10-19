@extends('layouts.site', [
    'title' => $siteSettings['site.title'] ?? 'Pakistan Peoples Party | District Dadu',
    'description' => $siteSettings['site.tagline'] ?? 'Pakistan Peoples Party District Dadu: committed to democracy, social justice and the welfare of the people.',
])

@section('content')
<main>
    <section class="hero-section" id="home">
        <video class="hero-background-video" autoplay muted loop playsinline preload="metadata" poster="{{ media_asset($hero['home.hero.poster'] ?? 'Assets/images/Mass-Rally-Beneath-a-Crescent-Flag.jpg') }}" aria-hidden="true">
            <source src="{{ media_asset($hero['home.hero.video'] ?? 'Assets/video/hero-section-bg.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-shade"></div>

        <!-- Top Leadership Row: Top Left (2), Top Center (2), Top Right (2) -->
        <div class="hero-top-leadership-row" aria-label="Party Leadership Row">
            <!-- Top Left: Ali Hassan Zardari, Faryal Talpur -->
            <div class="hero-leaders-col hero-leaders-top-left">
                <div class="hero-face-card">
                    <div class="hero-face-frame">
                        <img src="{{ media_asset($hero['home.hero.leader_left_1'] ?? 'Assets/images/hero/ali-hassan-zardari.jpg') }}" alt="{{ $hero['home.hero.leader_left_1_name'] ?? 'Ali Hassan Zardari' }}" loading="eager" style="width: 100%;height: 100%;object-fit: cover;">
                    </div>
                    <span class="hero-face-name">{{ $hero['home.hero.leader_left_1_name'] ?? 'Ali Hassan Zardari' }}</span>
                </div>
                <div class="hero-face-card">
                    <div class="hero-face-frame">
                        <img src="{{ media_asset($hero['home.hero.leader_left_2'] ?? 'Assets/images/hero/faryal-talpur.jpg') }}" alt="{{ $hero['home.hero.leader_left_2_name'] ?? 'Faryal Talpur' }}" loading="eager" style="width: 100%;height: 100%;object-fit: cover;">
                    </div>
                    <span class="hero-face-name">{{ $hero['home.hero.leader_left_2_name'] ?? 'Faryal Talpur' }}</span>
                </div>
            </div>

            <!-- Top Center: Zulfikar Ali Bhutto, Benazir Bhutto -->
            <div class="hero-leaders-col hero-leaders-top-center">
                <div class="hero-face-card hero-face-card-center">
                    <div class="hero-face-frame hero-face-frame-center">
                        <img src="{{ media_asset($hero['home.hero.leader_center_1'] ?? 'Assets/images/hero/zulfikar-ali-bhutto.jpg') }}" alt="{{ $hero['home.hero.leader_center_1_name'] ?? 'Zulfikar Ali Bhutto' }}" loading="eager" style="width: 100%;height: 100%;object-fit: cover;">
                    </div>
                    <span class="hero-face-name">{{ $hero['home.hero.leader_center_1_name'] ?? 'Zulfikar Ali Bhutto' }}</span>
                </div>
                <div class="hero-face-card hero-face-card-center">
                    <div class="hero-face-frame hero-face-frame-center">
                        <img src="{{ media_asset($hero['home.hero.leader_center_2'] ?? 'Assets/images/hero/benazir-bhutto.jpg') }}" alt="{{ $hero['home.hero.leader_center_2_name'] ?? 'Benazir Bhutto' }}" loading="eager" style="width: 100%;height: 100%;object-fit: cover;">
                    </div>
                    <span class="hero-face-name">{{ $hero['home.hero.leader_center_2_name'] ?? 'Benazir Bhutto' }}</span>
                </div>
            </div>

            <!-- Top Right: Asif Ali Zardari, Bakhtawar Bhutto Zardari -->
            <div class="hero-leaders-col hero-leaders-top-right">
                <div class="hero-face-card">
                    <div class="hero-face-frame">
                        <img src="{{ media_asset($hero['home.hero.leader_right_1'] ?? 'Assets/images/hero/asif-ali-zardari.jpg') }}" alt="{{ $hero['home.hero.leader_right_1_name'] ?? 'Asif Ali Zardari' }}" loading="eager" style="width: 100%;height: 100%;object-fit: cover;">
                    </div>
                    <span class="hero-face-name">{{ $hero['home.hero.leader_right_1_name'] ?? 'Asif Ali Zardari' }}</span>
                </div>
                <div class="hero-face-card">
                    <div class="hero-face-frame">
                        <img src="{{ media_asset($hero['home.hero.leader_right_2'] ?? 'Assets/images/hero/bakhtawar-bhutto-zardari.jpg') }}" alt="{{ $hero['home.hero.leader_right_2_name'] ?? 'Bakhtawar Bhutto Zardari' }}" loading="eager" style="width: 100%;height: 100%;object-fit: cover;">
                    </div>
                    <span class="hero-face-name">{{ $hero['home.hero.leader_right_2_name'] ?? 'Bakhtawar Bhutto Zardari' }}</span>
                </div>
            </div>
        </div>

        <!-- Center Content: Main Party Information -->
        <div class="hero-copy">
            <h1>{{ $hero['home.hero.title'] ?? 'Pakistan Peoples Party' }}</h1>
            <span class="hero-district">{{ $hero['home.hero.district'] ?? 'District Dadu' }}</span>
            <p>{{ $hero['home.hero.subtitle'] ?? 'Committed to Democracy, Social Justice and welfare of the people' }}</p>
            <div class="hero-actions">
                <a class="hero-button hero-button-primary" href="{{ $hero['home.hero.btn_primary_url'] ?? route('pages.president') }}">
                    {{ $hero['home.hero.btn_primary_text'] ?? 'Learn More' }} <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a class="hero-button hero-button-outline" href="{{ $hero['home.hero.btn_outline_url'] ?? '#about' }}">
                    {{ $hero['home.hero.btn_outline_text'] ?? 'Our Vision' }}
                </a>
            </div>
            <div class="hero-social">
                <span>Follow Us</span>
                <a href="{{ $siteSettings['site.facebook'] ?? route('pages.media-gallery') }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                <a href="{{ $siteSettings['site.twitter'] ?? route('pages.media-gallery') }}" target="_blank" rel="noopener" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                <a href="{{ $siteSettings['site.youtube'] ?? route('pages.media-gallery') }}" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
            </div>
        </div>
        <img class="hero-leader hero-leader-left" src="Assets/images/asifa bhutto zardari.png" alt="Asifa Bhutto Zardari">
        <img class="hero-leader hero-leader-right" src="Assets/images/Businessman-Explaining-with-Expressive-Hand-Gestures-1.png" alt="Party leader speaking with community members">
    </section>

    <!-- Party Values Strip -->
    <section class="values-strip" aria-label="Party values">
        <div class="values-strip-inner">
            @foreach ($values as $value)
                <article class="value-item">
                    <span class="value-icon value-icon-{{ $value['color'] ?? 'green' }}"><i class="fa-solid {{ $value['icon'] ?? 'fa-circle-check' }}" aria-hidden="true"></i></span>
                    <span class="value-copy">
                        <strong>{{ $value['title'] ?? '' }}</strong>
                        <span>{{ $value['subtitle'] ?? 'Working for a better tomorrow for all.' }}</span>
                    </span>
                </article>
            @endforeach
        </div>
    </section>

    <!-- Deputy Information Secretary Profile -->
    <section class="home-profile" id="profile" aria-labelledby="profile-title">
        <div class="home-profile-inner">
            <img src="{{ media_asset($profile['home.profile.image'] ?? 'Assets/images/Professional-Portrait-Cutout-on-Transparency.png') }}" alt="{{ $profile['home.profile.name'] ?? 'Sajad Ahmed Junejo' }}" loading="lazy">
            <div class="home-profile-copy">
                <h2 id="profile-title">{{ $profile['home.profile.name'] ?? 'Sajad Ahmed Junejo' }}</h2>
                <p class="profile-role">{{ $profile['home.profile.role'] ?? 'Website Operator | Deputy Information Secretary, Pakistan Peoples Party, District Dadu (Sindh)' }}</p>
                <p>{{ $profile['home.profile.bio1'] ?? 'Sajad Ahmed Junejo is associated with the Pakistan Peoples Party (PPP) as the Deputy Information Secretary for District Dadu, Sindh.' }}</p>
                @if (!empty($profile['home.profile.bio2']))
                    <p>{{ $profile['home.profile.bio2'] }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="home-about" id="about">
        <div class="home-about-inner">
            <div class="home-about-copy">
                <span class="eyebrow">{{ $about['home.about.eyebrow'] ?? 'About PPP District Dadu' }}</span>
                <h2>{{ $about['home.about.title'] ?? 'A Strong Voice for the people of Dadu' }}</h2>
                <p>{{ $about['home.about.description'] ?? 'Pakistan Peoples Party District Dadu is committed to democracy, social justice and the welfare of the people.' }}</p>
                <div class="about-principles">
                    @foreach ($about['home.about.principles'] ?? ['Democracy', 'Development', 'Social Justice', "People's Empowerment"] as $principle)
                        <span><i class="fa-solid fa-circle-check" aria-hidden="true"></i> {{ $principle }}</span>
                    @endforeach
                </div>
                <a class="about-more" href="{{ route('pages.president') }}">More About us <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="home-about-visual">
                <img src="{{ media_asset($about['home.about.image'] ?? 'Assets/images/ppp2-1024x568.jpg') }}" alt="Pakistan Peoples Party members serving the community" loading="lazy">
                <div class="about-stat-grid">
                    @foreach ($about['home.about.stats'] ?? [
                        ['value' => '25+', 'label' => 'Years of service'],
                        ['value' => '14', 'label' => 'Town Committees'],
                        ['value' => '50+', 'label' => 'Union Councils'],
                        ['value' => '100k+', 'label' => 'Party Members'],
                    ] as $statistic)
                        <div class="about-stat">
                            <strong>{{ $statistic['value'] ?? '25+' }}</strong>
                            <span>{{ $statistic['label'] ?? 'Years of service' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Slider -->
    @if ($leadershipSlides->isNotEmpty())
        <section class="home-leadership" id="leadership">
            <div class="home-section-inner">
                <div class="home-section-kicker">Our Leadership</div>
                <div id="leadershipCarousel" class="carousel slide home-carousel" data-bs-touch="true" data-bs-interval="false">
                    <div class="carousel-inner">
                        @foreach ($leadershipSlides as $slideIndex => $leaders)
                            <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
                                <div class="row g-3 justify-content-center leadership-carousel-track">
                                    @foreach ($leaders as $leader)
                                        <div class="col-6 col-md-3">
                                            <a class="home-leader-card" href="{{ $leader->link ?: route('pages.president') }}">
                                                <img src="{{ $leader->image_url }}" alt="{{ $leader->name }}" loading="lazy">
                                                <span class="home-leader-copy">
                                                    <small>{{ $leader->district ?: 'District Dadu' }}</small>
                                                    <strong>{{ $leader->name }}</strong>
                                                    <span>{{ $leader->role }}</span>
                                                </span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="home-carousel-controls">
                        <button class="carousel-control-prev" type="button" data-bs-target="#leadershipCarousel" data-bs-slide="prev" aria-label="Previous leadership">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <div class="carousel-indicators">
                            @foreach ($leadershipSlides as $slideIndex => $leaders)
                                <button type="button" data-bs-target="#leadershipCarousel" data-bs-slide-to="{{ $slideIndex }}" class="{{ $slideIndex === 0 ? 'active' : '' }}" aria-label="Leadership slide {{ $slideIndex + 1 }}" {{ $slideIndex === 0 ? 'aria-current=true' : '' }}></button>
                            @endforeach
                        </div>
                        <button class="carousel-control-next" type="button" data-bs-target="#leadershipCarousel" data-bs-slide="next" aria-label="Next leadership">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="home-updates" aria-label="Latest news and upcoming events">
        <div class="home-updates-inner">
            <span class="updates-label">Latest News</span>
            <div class="home-update-tabs">
                <a class="active" href="{{ route('pages.media-gallery') }}">Latest News</a>
                <a href="{{ route('pages.contact') }}">Upcoming Events</a>
            </div>
            <a class="updates-more" href="{{ route('pages.media-gallery') }}">See all updates <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </section>

    <!-- Media Gallery / Activities Slider -->
    @if ($activitySlides->isNotEmpty())
        <section class="home-gallery">
            <div class="home-gallery-heading">
                <span>Media Gallery</span>
                <h2>Moments from Our activities</h2>
            </div>
            <div id="activitiesCarousel" class="carousel slide home-carousel" data-bs-touch="true" data-bs-interval="false">
                <div class="carousel-inner home-gallery-track">
                    @foreach ($activitySlides as $slideIndex => $images)
                        <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
                            <div class="row g-3">
                                @foreach ($images as $image)
                                    <div class="col-6 col-md-3">
                                        <a class="home-gallery-item" href="{{ route('pages.media-gallery') }}" aria-label="Open the media gallery">
                                            <img src="{{ $image->image_url }}" alt="{{ $image->alt ?: ($image->title ?: 'Party Activity') }}" loading="lazy">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="home-carousel-controls">
                    <button class="carousel-control-prev" type="button" data-bs-target="#activitiesCarousel" data-bs-slide="prev" aria-label="Previous activities">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <div class="carousel-indicators">
                        @foreach ($activitySlides as $slideIndex => $images)
                            <button type="button" data-bs-target="#activitiesCarousel" data-bs-slide-to="{{ $slideIndex }}" class="{{ $slideIndex === 0 ? 'active' : '' }}" aria-label="Activities slide {{ $slideIndex + 1 }}" {{ $slideIndex === 0 ? 'aria-current=true' : '' }}></button>
                        @endforeach
                    </div>
                    <button class="carousel-control-next" type="button" data-bs-target="#activitiesCarousel" data-bs-slide="next" aria-label="Next activities">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </section>
    @endif

    <!-- Bottom Join Banner -->
    <section class="home-join">
        <div class="home-join-inner">
            <div>
                <h2>{{ $join['home.join.title'] ?? 'Join Hands For a Better Future' }}</h2>
                <p>{{ $join['home.join.description'] ?? 'Become a part of Pakistan Peoples Party District Dadu and contribute to the progress, peace and prosperity of our society.' }}</p>
            </div>
            <div class="home-join-actions">
                <a class="hero-button hero-button-primary" href="{{ $join['home.join.btn_primary_url'] ?? route('pages.join') }}">
                    {{ $join['home.join.btn_primary_text'] ?? 'Learn More' }} <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a class="hero-button hero-button-outline" href="{{ $join['home.join.btn_outline_url'] ?? '#about' }}">
                    {{ $join['home.join.btn_outline_text'] ?? 'Our Vision' }}
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
