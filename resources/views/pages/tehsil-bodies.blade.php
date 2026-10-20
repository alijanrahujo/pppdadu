<div class="tehsil-bodies-page">
    <section class="tehsil-bodies-heading">
        <h1>{!! str_contains($page['title'] ?? '', '<span>') ? $page['title'] : preg_replace('/(\bBodies\b)/i', '<span>$1</span>', $page['title'] ?? 'Tahseel <span>Bodies</span>') !!}</h1>
        <div class="tehsil-bodies-desc">
            {!! $page['description'] !!}
        </div>
    </section>

    @if (!empty($page['statistics']))
        <section class="tehsil-bodies-statistics" aria-label="Tehsil bodies statistics">
            @foreach ($page['statistics'] as $statistic)
                <article class="tehsil-bodies-stat">
                    <span class="tehsil-bodies-stat-icon tehsil-bodies-stat-icon-{{ $statistic['color'] ?? 'red' }}">
                        <i class="fa-solid {{ $statistic['icon'] ?? 'fa-landmark' }}" aria-hidden="true"></i>
                    </span>
                    <strong>{{ $statistic['value'] }}</strong>
                    <span class="tehsil-bodies-stat-label">{{ $statistic['label'] }}</span>
                </article>
            @endforeach
        </section>
    @endif

    <section class="tehsils-showcase" aria-label="Tehsil Organizations of District Dadu">
        @foreach ($page['tehsils'] as $index => $tehsil)
            <article class="tehsil-card" id="tehsil-{{ \Illuminate\Support\Str::slug($tehsil['name'] ?? 'tehsil-'.$index) }}">
                <header class="tehsil-card-header">
                    <div class="tehsil-header-left">
                        <div class="tehsil-title-group">
                            <div class="tehsil-icon-badge">
                                <i class="fa-solid fa-landmark"></i>
                            </div>
                            <div>
                                <h2>{{ $tehsil['name'] }}</h2>
                                @if (!empty($tehsil['urdu_name']))
                                    <span class="tehsil-urdu-tag">{{ $tehsil['urdu_name'] }}</span>
                                @endif
                            </div>
                        </div>
                        @if (!empty($tehsil['tagline']))
                            <div class="tehsil-tagline">
                                <i class="fa-solid fa-location-dot me-1"></i> {{ $tehsil['tagline'] }}
                            </div>
                        @endif
                        @if (!empty($tehsil['description']))
                            <p class="tehsil-description">{{ $tehsil['description'] }}</p>
                        @endif
                    </div>
                    @if (!empty($tehsil['image']))
                        <div class="tehsil-header-photo-wrap">
                            <img src="{{ media_asset($tehsil['image']) }}" alt="{{ $tehsil['name'] }}" class="tehsil-header-photo" loading="lazy">
                        </div>
                    @endif
                </header>

                <div class="tehsil-members-section">
                    <div class="tehsil-members-header">
                        <span class="tehsil-section-title">
                            <i class="fa-solid fa-users-gear me-1"></i> Tehsil Office Bearers
                        </span>
                        <span class="tehsil-members-count">
                            <i class="fa-solid fa-shield-halved me-1"></i> Verified Committee
                        </span>
                    </div>

                    <div class="tehsil-leader-grid">
                        @foreach ($tehsil['members'] ?? [] as $member)
                            @php
                                $roleLower = strtolower($member['role'] ?? '');
                                $isPresident = str_contains($roleLower, 'president') && !str_contains($roleLower, 'vice');
                                $isGS = str_contains($roleLower, 'general secretary') || str_contains($roleLower, 'gen. sec');
                                $isSVP = str_contains($roleLower, 'senior vice');
                                $isInfo = str_contains($roleLower, 'information');
                                $isFinance = str_contains($roleLower, 'finance');

                                $badgeClass = $isPresident ? 'badge-president' : ($isGS ? 'badge-gs' : ($isSVP ? 'badge-svp' : ($isInfo ? 'badge-info' : ($isFinance ? 'badge-finance' : 'badge-default'))));
                            @endphp
                            <article class="tehsil-leader-card {{ $isPresident ? 'card-highlight-president' : ($isGS ? 'card-highlight-gs' : '') }}">
                                <div class="tehsil-leader-image-wrap">
                                    <img class="tehsil-leader-img"
                                         src="{{ media_asset($member['image'] ?? null, 'Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png') }}"
                                         alt="{{ $member['name'] }}"
                                         loading="lazy">
                                    <div class="tehsil-leader-role-tag {{ $badgeClass }}">
                                        {{ $member['role'] }}
                                    </div>
                                </div>
                                <div class="tehsil-leader-info">
                                    <h3 class="tehsil-leader-name">{{ $member['name'] }}</h3>
                                    <span class="tehsil-leader-division">{{ $tehsil['name'] }}</span>
                                    @if (!empty($member['phone']))
                                        <a href="tel:{{ $member['phone'] }}" class="tehsil-leader-phone">
                                            <i class="fa-solid fa-phone"></i> {{ $member['phone'] }}
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </article>
        @endforeach
    </section>

    @if (!empty($page['priorities']))
        <section class="tehsil-bodies-priorities" aria-labelledby="tehsil-bodies-priorities-title">
            <header>
                <h2 id="tehsil-bodies-priorities-title">Key <span>Responsibilities</span></h2>
                <p>Working around the clock to uphold party discipline, serve the public, and advocate for District Dadu’s grassroots progress.</p>
            </header>
            <div class="tehsil-priority-grid">
                @foreach ($page['priorities'] as $priority)
                    <article class="tehsil-priority-card">
                        <span><i class="fa-solid {{ $priority['icon'] ?? 'fa-circle-check' }}" aria-hidden="true"></i></span>
                        <h3>{{ $priority['title'] }}</h3>
                        <p>{{ $priority['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="tehsil-bodies-impact">
        <span class="tehsil-bodies-impact-icon"><i class="fa-solid fa-people-roof" aria-hidden="true"></i></span>
        <div class="tehsil-bodies-impact-copy">
            <h2>United for Grassroots Democracy</h2>
            <p>Our Tehsil Bodies form the living link between our party leadership and the courageous people of District Dadu across all towns and union councils.</p>
        </div>
        <div class="tehsil-bodies-impact-action">
            <a href="{{ route('pages.join') }}" class="btn btn-sm btn-light text-dark fw-bold px-3 py-2 me-2">
                <i class="fa-solid fa-user-plus me-1"></i> Join PPP
            </a>
            <a href="{{ route('pages.contact') }}" class="btn btn-sm btn-outline-light px-3 py-2">
                <i class="fa-solid fa-envelope me-1"></i> Contact Us
            </a>
        </div>
    </section>
</div>
