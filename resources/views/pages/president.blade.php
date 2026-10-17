<div class="president-profile">
    <section class="president-intro">
        <div class="president-intro-copy">
            <h1>About Our <span>President</span></h1>
            <h2>{{ $page['subtitle'] }}</h2>
            <p class="president-role">MPA and District President</p>
            <p class="president-party">Pakistan Peoples Party, District Dadu</p>
            <p>Barrister Pir Mujeeb-ul-Haq is a dedicated leader, known for his unwavering commitment to democracy, social justice, and the welfare of the people.</p>
            <p>With strong roots in public service and a vision for a progressive Dadu, he continues to work tirelessly for the rights of every citizen and the development of our district.</p>

            <div class="president-principles">
                @foreach ([
                    ['title' => "Advocate for People's Rights", 'description' => 'Always raising voice for the rights of the people.', 'icon' => 'fa-bullhorn'],
                    ['title' => 'Development Focused', 'description' => 'Working for education, health, infrastructure and youth empowerment.', 'icon' => 'fa-chart-line'],
                    ['title' => 'Democracy & Justice', 'description' => 'Strong believer in democracy, fairness and equal opportunities.', 'icon' => 'fa-scale-balanced'],
                    ['title' => 'Community First', 'description' => 'Dedicated to building a united, peaceful and prosperous Dadu.', 'icon' => 'fa-people-group'],
                ] as $principle)
                    <article class="president-principle">
                        <span><i class="fa-solid {{ $principle['icon'] }}" aria-hidden="true"></i></span>
                        <div>
                            <h3>{{ $principle['title'] }}</h3>
                            <p>{{ $principle['description'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="president-photo">
            <img src="{{ media_asset($page['image']) }}" alt="{{ $page['image_alt'] }}">
        </div>
    </section>

    <section class="president-impact" aria-label="President's statement and service statistics">
        <blockquote class="president-quote">
            <span class="quote-mark" aria-hidden="true">&rdquo;</span>
            <div>
                <p>“My mission is to serve the people of Dadu with honesty, transparency and dedication, and to build a stronger, progressive and united society.”</p>
                <cite>- Barrister Pir Mujeeb-ul-Haq</cite>
                <span>President, PPP District Dadu</span>
            </div>
        </blockquote>
        <div class="president-statistics">
            @foreach ([
                ['value' => '25+', 'label' => 'Years of service', 'icon' => 'fa-people-group'],
                ['value' => '100k+', 'label' => 'People represented', 'icon' => 'fa-users'],
                ['value' => '50+', 'label' => 'Union councils', 'icon' => 'fa-location-dot'],
                ['value' => '10k+', 'label' => 'Active supporters', 'icon' => 'fa-heart'],
            ] as $statistic)
                <div class="president-stat">
                    <i class="fa-solid {{ $statistic['icon'] }}" aria-hidden="true"></i>
                    <strong>{{ $statistic['value'] }}</strong>
                    <span>{{ $statistic['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="president-mission">
        <h2>Our <span>Mission</span> &amp; <span class="vision-word">Vision</span></h2>
        <div class="president-purpose-grid">
            <article class="president-purpose-card">
                <span class="purpose-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></span>
                <div><h3>Our Mission</h3><p>{{ $page['mission'] }}</p></div>
            </article>
            <article class="president-purpose-card">
                <span class="purpose-icon"><i class="fa-solid fa-eye" aria-hidden="true"></i></span>
                <div><h3>Our Vision</h3><p>{{ $page['vision'] }}</p></div>
            </article>
            <article class="president-purpose-card president-purpose-quote">
                <span class="purpose-icon"><i class="fa-solid fa-quote-left" aria-hidden="true"></i></span>
                <div><h3>Our Commitment</h3><p>{{ $page['quote'] }}</p><strong>- Barrister Pir Mujeeb-ul-Haq</strong></div>
            </article>
        </div>
    </section>

    <section class="president-achievements">
        <h2>Key <span>Achievements</span></h2>
        <div class="president-achievement-track">
            @foreach ($page['achievements'] as $achievement)
                <article class="president-achievement">
                    <i class="fa-solid {{ $achievement['icon'] }}" aria-hidden="true"></i>
                    <div><h3>{{ $achievement['title'] }}</h3><p>{{ $achievement['description'] }}</p></div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="president-journey">
        <h2>Our Journey of <span>Service</span></h2>
        <ol class="president-timeline">
            @foreach ($page['journey'] as $milestone)
                <li>
                    <span class="timeline-icon"><i class="fa-solid {{ ['fa-calendar-days', 'fa-people-group', 'fa-users', 'fa-chart-line', 'fa-bullseye'][$loop->index] }}" aria-hidden="true"></i></span>
                    <strong>{{ $milestone['period'] }}</strong>
                    <p>{{ $milestone['description'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    <section class="president-join">
        <span class="president-join-icon"><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
        <div>
            <h2>Join Hands for a Stronger Dadu</h2>
            <p>Let's work together for peace, progress and a better tomorrow.</p>
        </div>
        <a href="{{ route('pages.join') }}"><i class="fa-solid fa-people-group" aria-hidden="true"></i> Join PPP Today</a>
    </section>
</div>
