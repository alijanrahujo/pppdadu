<div class="president-profile">
    <section class="president-intro">
        <div class="president-intro-copy">
            <h1>About Our <span>General Secretary</span></h1>
            <h2>{{ $page['subtitle'] }}</h2>
            <p class="president-role">{{ $page['role'] ?? 'General Secretary' }}</p>
            <p class="president-party">Pakistan Peoples Party, District Dadu</p>
            
            {!! $page['description'] !!}

            <div class="president-principles">
                @php
                    $principleIcons = ['fa-people-group', 'fa-handshake-angle', 'fa-bullhorn', 'fa-chart-line'];
                    $principleDescs = [
                        'Leading the team with vision, integrity and dedication.',
                        'Strengthening the party structure at all levels across the district.',
                        'Always ready to serve the people and address their issues.',
                        'Working for the political awareness and empowerment of youth.'
                    ];
                @endphp
                @foreach ($page['principles'] as $index => $principle)
                    <article class="president-principle">
                        <span><i class="fa-solid {{ is_array($principle) ? ($principle['icon'] ?? ($principleIcons[$index] ?? 'fa-check')) : ($principleIcons[$index] ?? 'fa-check') }}" aria-hidden="true"></i></span>
                        <div>
                            <h3>{{ is_array($principle) ? ($principle['title'] ?? '') : $principle }}</h3>
                            <p>{{ is_array($principle) ? ($principle['description'] ?? '') : ($principleDescs[$index] ?? '') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="president-photo">
            <img src="{{ media_asset($page['image']) }}" alt="{{ $page['image_alt'] }}">
        </div>
    </section>

    <section class="president-impact" aria-label="General Secretary statement and service statistics">
        <blockquote class="president-quote">
            <span class="quote-mark" aria-hidden="true">&rdquo;</span>
            <div>
                {!! $page['statement'] ?? ('<p>“' . e($page['quote']) . '”</p><cite>- ' . e($page['subtitle']) . '</cite><span>General Secretary, PPP District Dadu</span>') !!}
            </div>
        </blockquote>
        <div class="president-statistics">
            @foreach ([
                ['value' => '25+', 'label' => 'Years of service', 'icon' => 'fa-people-group'],
                ['value' => '100+', 'label' => 'Party workers', 'icon' => 'fa-building-columns'],
                ['value' => '50+', 'label' => 'UC committees', 'icon' => 'fa-location-dot'],
                ['value' => '10k+', 'label' => 'People connected', 'icon' => 'fa-people-group'],
            ] as $statistic)
                <div class="president-stat">
                    <i class="fa-solid {{ $statistic['icon'] }}" aria-hidden="true"></i>
                    <strong>{{ $statistic['value'] }}</strong>
                    <span>{{ $statistic['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="secretary-commitments">
        <h2>Committed to the <span>people</span></h2>
        <p>Working for the development, rights and prosperity of every citizen of District Dadu.</p>
        <div class="secretary-commitment-grid">
            @foreach ($page['commitments'] as $commitment)
                <article class="secretary-commitment">
                    <i class="fa-solid {{ $commitment['icon'] }}" aria-hidden="true"></i>
                    <h3>{{ $commitment['title'] }}</h3>
                    <p>{{ $commitment['description'] }}</p>
                </article>
            @endforeach
        </div>
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
