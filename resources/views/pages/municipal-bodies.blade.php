<div class="municipal-bodies-page">
    <section class="municipal-bodies-heading">
        <h1>Municipal <span>&amp; Town Bodies</span></h1>
        <p>{{ $page['description'] }}</p>
    </section>

    <section class="municipal-bodies-statistics" aria-label="Municipal and town body statistics">
        @foreach ($page['statistics'] as $statistic)
            <article class="municipal-bodies-stat">
                <span class="municipal-bodies-stat-icon municipal-bodies-stat-icon-{{ $statistic['color'] }}">
                    <i class="fa-solid {{ $statistic['icon'] }}" aria-hidden="true"></i>
                </span>
                <strong>{{ $statistic['value'] }}</strong>
                <span class="municipal-bodies-stat-label">{{ $statistic['label'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="municipal-bodies-priorities" aria-labelledby="municipal-bodies-priorities-title">
        <header>
            <h2 id="municipal-bodies-priorities-title">Working for <span>Stronger Communities</span></h2>
            <p>{{ $page['description'] }}</p>
        </header>
        <div class="municipal-bodies-priority-grid">
            @foreach ($page['priorities'] as $priority)
                <article class="municipal-bodies-priority">
                    <span><i class="fa-solid {{ $priority['icon'] }}" aria-hidden="true"></i></span>
                    <h3>{{ $priority['title'] }}</h3>
                    <p>{{ $priority['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="municipal-bodies-roster" aria-labelledby="municipal-bodies-roster-title">
        <span class="municipal-bodies-roster-icon"><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i></span>
        <div>
            <span class="eyebrow">Office bearers</span>
            <h2 id="municipal-bodies-roster-title">Local Representatives</h2>
            <p>A verified roster of municipal and town office bearers is not currently available. Contact the district team for up-to-date committee details.</p>
            <a href="{{ route('pages.contact') }}">Send an inquiry <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </section>

    <section class="municipal-bodies-impact">
        <span class="municipal-bodies-impact-icon"><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
        <div class="municipal-bodies-impact-copy">
            <h2>Working for Stronger Communities</h2>
            <p>Our municipal and town bodies are playing a vital role in building a better, cleaner and developed District Dadu. Together we can create a brighter future for our people.</p>
        </div>
        <div class="municipal-bodies-impact-priorities">
            @foreach ([
                ['title' => 'Better Governance', 'icon' => 'fa-landmark'],
                ['title' => 'Local Development', 'icon' => 'fa-chart-line'],
                ['title' => 'Community Support', 'icon' => 'fa-people-group'],
                ['title' => 'Public Welfare', 'icon' => 'fa-hand-holding-heart'],
            ] as $priority)
                <span><i class="fa-solid {{ $priority['icon'] }}" aria-hidden="true"></i>{{ $priority['title'] }}</span>
            @endforeach
        </div>
    </section>
</div>
