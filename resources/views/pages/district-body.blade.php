<div class="district-body-page">
    <section class="district-body-heading">
        <h1>District <span>Body</span></h1>
        <p>{{ $page['description'] }}</p>
    </section>

    <section class="district-member-grid" aria-label="District body members">
        @foreach ($page['members'] as $member)
            @if (!empty($member['link']))
                <a href="{{ $member['link'] }}" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                    <article class="district-member-card" style="height: 100%;">
                        <img src="{{ $member['image_url'] ?? asset('Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png') }}" alt="{{ $member['name'] }}" loading="lazy">
                        <div>
                            <h2>{{ $member['name'] }}</h2>
                            <p>{{ $member['role'] }}</p>
                        </div>
                    </article>
                </a>
            @else
                <article class="district-member-card">
                    <img src="{{ $member['image_url'] ?? asset('Assets/images/bdb31113-7f3c-41d4-8673-11cdb7bacf93.png') }}" alt="{{ $member['name'] }}" loading="lazy">
                    <div>
                        <h2>{{ $member['name'] }}</h2>
                        <p>{{ $member['role'] }}</p>
                    </div>
                </article>
            @endif
        @endforeach
    </section>

    <section class="district-responsibilities">
        <h2>Our <span>Responsibilities</span></h2>
        <p>We are committed to serve the people and work for the development, rights and prosperity of District Dadu.</p>
        <div class="district-responsibility-grid">
            @foreach ($page['principles'] as $principle)
                <article class="district-responsibility-card">
                    <i class="fa-solid {{ $principle['icon'] }}" aria-hidden="true"></i>
                    <h3>{{ $principle['title'] }}</h3>
                    <p>{{ $principle['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="district-impact" aria-label="District service statistics">
        <div class="district-impact-intro">
            <span><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
            <div>
                <h2>United for a<br>Stronger Dadu</h2>
                <p>Our District Body is committed to serving the people and building a democratic, peaceful and prosperous District Dadu.</p>
            </div>
        </div>
        <div class="district-impact-statistics">
            @foreach ([
                ['value' => '25+', 'label' => 'Years of service', 'icon' => 'fa-people-group'],
                ['value' => '100+', 'label' => 'Active workers', 'icon' => 'fa-users'],
                ['value' => '50+', 'label' => 'Union Councils', 'icon' => 'fa-location-dot'],
                ['value' => '10k+', 'label' => 'Active supporters', 'icon' => 'fa-people-group'],
            ] as $statistic)
                <div class="district-impact-stat">
                    <i class="fa-solid {{ $statistic['icon'] }}" aria-hidden="true"></i>
                    <strong>{{ $statistic['value'] }}</strong>
                    <span>{{ $statistic['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>
</div>
