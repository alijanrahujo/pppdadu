{{-- Members Area Page Heading --}}
<header class="membership-page-heading">
    <h1>Members <span>Area</span></h1>
    <p>{{ $page['subtitle'] ?? 'Registered members, activists and volunteers of Pakistan Peoples Party District Dadu.' }}</p>
</header>

{{-- Membership Stats Summary --}}
<div class="row g-3 mb-4 members-stats-row">
    <div class="col-6 col-md-3">
        <div class="members-stat-card">
            <span class="stat-icon"><i class="fa-solid fa-users text-danger"></i></span>
            <div>
                <strong class="stat-number">{{ number_format($page['stats']['total'] ?? 0) }}</strong>
                <span class="stat-label">Total Members</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="members-stat-card">
            <span class="stat-icon"><i class="fa-solid fa-id-card text-success"></i></span>
            <div>
                <strong class="stat-number">{{ number_format($page['stats']['primary'] ?? 0) }}</strong>
                <span class="stat-label">Primary Members</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="members-stat-card">
            <span class="stat-icon"><i class="fa-solid fa-bolt text-warning"></i></span>
            <div>
                <strong class="stat-number">{{ number_format($page['stats']['youth'] ?? 0) }}</strong>
                <span class="stat-label">Youth Wing</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="members-stat-card">
            <span class="stat-icon"><i class="fa-solid fa-venus text-primary"></i></span>
            <div>
                <strong class="stat-number">{{ number_format($page['stats']['women'] ?? 0) }}</strong>
                <span class="stat-label">Women Wing</span>
            </div>
        </div>
    </div>
</div>

{{-- Search & Filter Controls --}}
<div class="members-filter-bar card border-0 shadow-sm rounded-3 p-3 mb-4 bg-white">
    <form action="{{ route('pages.members') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-12 col-md-4">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name, profession, tehsil..." value="{{ $page['search'] ?? '' }}">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <select name="wing" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="all" {{ empty($page['wing']) || $page['wing'] === 'all' ? 'selected' : '' }}>All Member Types</option>
                <option value="Primary Member" {{ ($page['wing'] ?? '') === 'Primary Member' ? 'selected' : '' }}>Primary Member</option>
                <option value="General Member" {{ ($page['wing'] ?? '') === 'General Member' ? 'selected' : '' }}>General Member</option>
                <option value="Youth Wing" {{ ($page['wing'] ?? '') === 'Youth Wing' ? 'selected' : '' }}>Youth Wing</option>
                <option value="Women Wing" {{ ($page['wing'] ?? '') === 'Women Wing' ? 'selected' : '' }}>Women Wing</option>
                <option value="Labour Wing" {{ ($page['wing'] ?? '') === 'Labour Wing' ? 'selected' : '' }}>Labour Wing</option>
                <option value="Peoples Student Federation" {{ ($page['wing'] ?? '') === 'Peoples Student Federation' ? 'selected' : '' }}>Peoples Student Federation</option>
                <option value="Lawyers Forum" {{ ($page['wing'] ?? '') === 'Lawyers Forum' ? 'selected' : '' }}>Lawyers Forum</option>
                <option value="Overseas Member" {{ ($page['wing'] ?? '') === 'Overseas Member' ? 'selected' : '' }}>Overseas Member</option>
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select name="city" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="all" {{ empty($page['city']) || $page['city'] === 'all' ? 'selected' : '' }}>All Tehsils</option>
                <option value="Dadu" {{ ($page['city'] ?? '') === 'Dadu' ? 'selected' : '' }}>Dadu</option>
                <option value="Mehar" {{ ($page['city'] ?? '') === 'Mehar' ? 'selected' : '' }}>Mehar</option>
                <option value="Khairpur Nathan Shah" {{ ($page['city'] ?? '') === 'Khairpur Nathan Shah' ? 'selected' : '' }}>K.N. Shah</option>
                <option value="Johi" {{ ($page['city'] ?? '') === 'Johi' ? 'selected' : '' }}>Johi</option>
            </select>
        </div>
        <div class="col-12 col-md-3 d-flex gap-2 justify-content-md-end">
            <button type="submit" class="btn btn-sm btn-outline-secondary px-3">
                Filter
            </button>
            @if (!empty($page['search']) || (!empty($page['wing']) && $page['wing'] !== 'all') || (!empty($page['city']) && $page['city'] !== 'all'))
                <a href="{{ route('pages.members') }}" class="btn btn-sm btn-light border text-secondary" title="Reset Filters">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
            <a href="{{ route('pages.join') }}" class="btn btn-sm btn-danger text-nowrap fw-bold" style="background-color: #c8102e; border-color: #c8102e;">
                <i class="fa-solid fa-user-plus me-1"></i> Join PPP
            </a>
        </div>
    </form>
</div>

{{-- Members Directory Grid --}}
<div class="row g-3 mb-4 members-grid">
    @forelse ($page['members'] as $member)
        <div class="col-md-6 col-lg-4">
            <article class="member-profile-card h-100">
                <div class="member-card-header">
                    <div class="member-avatar-wrap">
                        @if (!empty($member->profile_picture))
                            <img src="{{ asset('storage/' . $member->profile_picture) }}" alt="{{ $member->full_name }}" class="member-avatar" loading="lazy">
                        @else
                            <div class="member-avatar-placeholder">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                        <span class="member-verified-badge" title="Verified PPP Member">
                            <i class="fa-solid fa-check"></i>
                        </span>
                    </div>
                    <div class="member-header-info">
                        <h3 class="member-name text-truncate" title="{{ $member->full_name }}">{{ $member->full_name }}</h3>
                        <div class="d-flex flex-wrap gap-1 align-items-center mb-1">
                            <span class="badge member-wing-badge">{{ $member->member_type ?? 'Member' }}</span>
                            <span class="member-code">#{{ str_pad($member->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

                <div class="member-card-body">
                    <div class="member-meta-row">
                        <i class="fa-solid fa-location-dot text-danger"></i>
                        <span class="text-truncate">{{ $member->tehsil_city ?? 'District Dadu' }}, {{ $member->province ?? 'Sindh' }}</span>
                    </div>

                    @if (!empty($member->profession))
                        <div class="member-meta-row">
                            <i class="fa-solid fa-briefcase text-success"></i>
                            <span class="text-truncate">{{ $member->profession }}</span>
                        </div>
                    @endif

                    @if (!empty($member->education))
                        <div class="member-meta-row">
                            <i class="fa-solid fa-graduation-cap text-primary"></i>
                            <span class="text-truncate">{{ $member->education }}</span>
                        </div>
                    @endif

                    <div class="member-meta-row">
                        <i class="fa-regular fa-calendar text-muted"></i>
                        <span>Joined {{ $member->created_at->format('M Y') }}</span>
                    </div>
                </div>

                @if (!empty($member->volunteering) && is_array($member->volunteering))
                    <div class="member-volunteering-row">
                        @foreach (array_slice($member->volunteering, 0, 2) as $vol)
                            <span class="member-vol-badge">{{ $vol }}</span>
                        @endforeach
                        @if (count($member->volunteering) > 2)
                            <span class="member-vol-badge text-muted">+{{ count($member->volunteering) - 2 }}</span>
                        @endif
                    </div>
                @endif

                @if (!empty($member->facebook_url) || !empty($member->twitter_url) || !empty($member->instagram_url) || !empty($member->tiktok_url))
                    <div class="member-card-footer">
                        <div class="member-social-icons">
                            @if (!empty($member->facebook_url))
                                <a href="{{ $member->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                            @endif
                            @if (!empty($member->twitter_url))
                                <a href="{{ $member->twitter_url }}" target="_blank" rel="noopener" aria-label="Twitter / X" title="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            @endif
                            @if (!empty($member->instagram_url))
                                <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                            @endif
                            @if (!empty($member->tiktok_url))
                                <a href="{{ $member->tiktok_url }}" target="_blank" rel="noopener" aria-label="TikTok" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                            @endif
                        </div>
                    </div>
                @endif
            </article>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 p-5 text-center bg-white">
                <div class="text-muted mb-3">
                    <i class="fa-solid fa-users-slash fa-3x text-muted"></i>
                </div>
                <h3 class="h5 fw-bold text-dark mb-2">No Members Found</h3>
                <p class="text-secondary small mb-4">No registered members matched your search criteria. Be part of Pakistan Peoples Party today!</p>
                <div>
                    <a href="{{ route('pages.join') }}" class="btn btn-danger fw-bold px-4" style="background-color: #c8102e; border-color: #c8102e;">
                        <i class="fa-solid fa-user-plus me-1"></i> Register as a Member
                    </a>
                    @if (!empty($page['search']) || !empty($page['wing']) || !empty($page['city']))
                        <a href="{{ route('pages.members') }}" class="btn btn-outline-secondary ms-2 px-3">Clear Filters</a>
                    @endif
                </div>
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination Links --}}
@if ($page['members']->hasPages())
    <div class="d-flex justify-content-center mb-4">
        {{ $page['members']->links() }}
    </div>
@endif

{{-- Join Call to Action Banner --}}
<div class="card border-0 shadow-sm rounded-3 p-4 mb-4 text-white" style="background: linear-gradient(135deg, #0b603d 0%, #15803d 50%, #000000 100%);">
    <div class="row align-items-center gy-3">
        <div class="col-md-8">
            <span class="badge bg-warning text-dark fw-bold mb-2">Be Part of the Movement</span>
            <h3 class="h4 fw-bold mb-1">Become an Official PPP Member Today</h3>
            <p class="mb-0 text-white-50 small">Join hands with Pakistan Peoples Party District Dadu to contribute to democracy, human rights, and social justice.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('pages.join') }}" class="btn btn-light text-dark fw-bold px-4 py-2 shadow-sm">
                Join PPP (Online Form) <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

{{-- Community Impact Banner (Matches Contact, District Body, Leadership pages) --}}
<section class="membership-impact" aria-label="Community impact">
    <div class="membership-impact-message">
        <span><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
        <div>
            <h2>Working for Stronger Communities</h2>
            <p>Our municipal and town bodies are playing a vital role in building a better, cleaner and developed District Dadu. Together we can create a brighter future for our people.</p>
        </div>
    </div>
    <ul>
        <li><i class="fa-solid fa-landmark" aria-hidden="true"></i><span>Better Governance</span></li>
        <li><i class="fa-solid fa-chart-line" aria-hidden="true"></i><span>Local Development</span></li>
        <li><i class="fa-solid fa-users" aria-hidden="true"></i><span>Community Support</span></li>
        <li><i class="fa-solid fa-scale-balanced" aria-hidden="true"></i><span>Public Welfare</span></li>
    </ul>
</section>
