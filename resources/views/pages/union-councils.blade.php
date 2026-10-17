<div class="union-councils-page">
    <section class="union-councils-heading">
        <h1>Union Council <span>Bodies &amp; Members</span></h1>
        <p>Our Union Councils are the strength of our organization at the grassroots level.<br>Meet the dedicated office bearers and members working for the people of District Dadu.</p>
    </section>

    <section class="union-council-statistics" aria-label="Union council statistics">
        @foreach ($page['statistics'] as $statistic)
            <article class="union-council-stat">
                <span class="union-council-stat-icon union-council-stat-icon-{{ $statistic['color'] }}">
                    <i class="fa-solid {{ $statistic['icon'] }}" aria-hidden="true"></i>
                </span>
                <strong>{{ $statistic['value'] }}</strong>
                <span class="union-council-stat-label">{{ $statistic['label'] }}</span>
            </article>
        @endforeach
    </section>

    <section class="union-council-grid" aria-label="Union councils and members">
        @foreach ($page['councils'] as $index => $council)
            <article class="union-council-card" id="union-council-{{ $index + 1 }}">
                <img class="union-council-cover" src="{{ media_asset($council['image']) }}" alt="" loading="lazy">
                <h2>{{ $council['name'] }}</h2>
                <div class="union-council-members">
                    @foreach ($council['members'] as $memberIndex => $member)
                        <div class="union-council-member {{ $memberIndex === 0 ? 'union-council-chairman' : '' }}">
                            <img src="{{ media_asset($member['image']) }}" alt="" loading="lazy">
                            <div>
                                <strong>{{ $member['role'] }}</strong>
                                <span>{{ $member['name'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="union-council-link" href="{{ route('pages.contact') }}" aria-label="Contact us about {{ $council['name'] }}">
                    Click here <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                </a>
            </article>
        @endforeach
    </section>

    <section class="union-council-join">
        <span><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
        <div>
            <h2>Working for Stronger Communities</h2>
            <p>Our municipal and town bodies are playing a vital role in building a better, cleaner and developed District Dadu. Together we can create a brighter future for our people.</p>
        </div>
        <div class="union-council-priorities">
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
