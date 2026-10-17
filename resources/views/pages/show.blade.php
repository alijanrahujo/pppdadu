@extends('layouts.site', [
    'title' => $page['title'].' | Pakistan Peoples Party District Dadu',
    'description' => $page['subtitle'],
])

@section('content')
<main>
    @unless (in_array($page['layout'] ?? null, ['president', 'general-secretary', 'district-body', 'leadership', 'union-councils', 'municipal-bodies', 'media-gallery', 'membership', 'contact'], true))
        <section class="page-banner">
            <div class="container">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page['title'] }}</li>
                    </ol>
                </nav>
                <span class="eyebrow">{{ $page['eyebrow'] }}</span>
                <h1>{{ $page['title'] }}</h1>
                <p>{{ $page['subtitle'] }}</p>
            </div>
        </section>
    @endunless

    <section class="page-main section-space {{ in_array($page['layout'] ?? null, ['president', 'general-secretary', 'district-body', 'leadership', 'union-councils'], true) ? 'president-page-main' : '' }} {{ ($page['layout'] ?? null) === 'media-gallery' ? 'media-gallery-page-main' : '' }} {{ ($page['layout'] ?? null) === 'membership' ? 'membership-page-main' : '' }} {{ ($page['layout'] ?? null) === 'contact' ? 'contact-page-main' : '' }} {{ ($page['layout'] ?? null) === 'municipal-bodies' ? 'municipal-page-main' : '' }}">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success submission-alert" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger submission-alert" role="alert">
                    <strong>Please check the highlighted form details and try again.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (($page['layout'] ?? null) === 'president')
                @include('pages.president')
            @elseif (($page['layout'] ?? null) === 'general-secretary')
                @include('pages.general-secretary')
            @elseif (($page['layout'] ?? null) === 'district-body')
                @include('pages.district-body')
            @elseif (($page['layout'] ?? null) === 'leadership')
                @include('pages.leadership')
            @elseif (($page['layout'] ?? null) === 'union-councils')
                @include('pages.union-councils')
            @elseif (($page['layout'] ?? null) === 'municipal-bodies')
                @include('pages.municipal-bodies')
            @elseif ($page['type'] === 'profile')
                <div class="profile-layout">
                    <div class="profile-photo-wrap">
                        <img class="profile-photo" src="{{ asset('Assets/images/'.$page['image']) }}" alt="{{ $page['image_alt'] }}" loading="lazy">
                    </div>
                    <div class="profile-copy">
                        <span class="eyebrow">{{ $page['role'] }}</span>
                        <h2 class="section-title">{{ $page['subtitle'] }}</h2>
                        <p class="section-lead">{{ $page['description'] }}</p>
                        <div class="profile-principles">
                            @foreach ($page['principles'] as $principle)
                                <div><i class="fa-solid fa-check" aria-hidden="true"></i>{{ $principle }}</div>
                            @endforeach
                        </div>
                        <blockquote class="leadership-quote">“{{ $page['quote'] }}”</blockquote>
                    </div>
                </div>
                @if (isset($page['mission'], $page['vision']))
                    <section class="profile-purpose section-panel">
                        <div class="section-heading text-center">
                            <span class="eyebrow">Our direction</span>
                            <h2>Our Mission &amp; Vision</h2>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <article class="purpose-card h-100">
                                    <span class="purpose-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></span>
                                    <h3>Our Mission</h3>
                                    <p>{{ $page['mission'] }}</p>
                                </article>
                            </div>
                            <div class="col-md-6">
                                <article class="purpose-card h-100">
                                    <span class="purpose-icon"><i class="fa-regular fa-eye" aria-hidden="true"></i></span>
                                    <h3>Our Vision</h3>
                                    <p>{{ $page['vision'] }}</p>
                                </article>
                            </div>
                        </div>
                    </section>
                @endif
                @if (isset($page['achievements']))
                    <section class="profile-achievements section-panel">
                        <div class="section-heading text-center">
                            <span class="eyebrow">Public service</span>
                            <h2>Key Areas of Work</h2>
                        </div>
                        <div class="row g-4">
                            @foreach ($page['achievements'] as $achievement)
                                <div class="col-sm-6 col-lg-4">
                                    <article class="commitment-card h-100">
                                        <i class="fa-solid {{ $achievement['icon'] }}" aria-hidden="true"></i>
                                        <h3>{{ $achievement['title'] }}</h3>
                                        <p>{{ $achievement['description'] }}</p>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <section class="profile-journey section-panel">
                        <div class="section-heading text-center">
                            <span class="eyebrow">A record of service</span>
                            <h2>Our Journey</h2>
                        </div>
                        <ol class="journey-list">
                            @foreach ($page['journey'] as $milestone)
                                <li>
                                    <span class="journey-period">{{ $milestone['period'] }}</span>
                                    <p>{{ $milestone['description'] }}</p>
                                </li>
                            @endforeach
                        </ol>
                    </section>
                @endif
                @if (isset($page['commitments']))
                    <section class="profile-commitments section-panel">
                        <div class="section-heading text-center">
                            <span class="eyebrow">Committed to the people</span>
                            <h2>Principles in Practice</h2>
                            <p>Working for the development, rights and prosperity of every citizen of District Dadu.</p>
                        </div>
                        <div class="row g-4">
                            @foreach ($page['commitments'] as $commitment)
                                <div class="col-sm-6 col-lg-4">
                                    <article class="commitment-card h-100">
                                        <i class="fa-solid {{ $commitment['icon'] }}" aria-hidden="true"></i>
                                        <h3>{{ $commitment['title'] }}</h3>
                                        <p>{{ $commitment['description'] }}</p>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @elseif ($page['type'] === 'directory')
                <div class="content-intro text-center">
                    <span class="eyebrow">District Dadu</span>
                    <h2 class="section-title">{{ $page['subtitle'] }}</h2>
                    <p class="section-lead">{{ $page['description'] }}</p>
                </div>
                <div class="row g-3 member-grid">
                    @foreach ($page['members'] as $index => $member)
                        <div class="col-sm-6 col-lg-4">
                            <article class="member-card h-100">
                                <span class="member-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $member['name'] }}</h3>
                                <p>{{ $member['role'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="row g-3 responsibility-grid">
                    @foreach ($page['principles'] as $principle)
                        <div class="col-sm-6 col-lg">
                            <article class="responsibility-card h-100">
                                <i class="fa-solid {{ $principle['icon'] }}" aria-hidden="true"></i>
                                <h3>{{ $principle['title'] }}</h3>
                                <p>{{ $principle['description'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>
            @elseif ($page['type'] === 'municipal')
                <div class="content-intro text-center">
                    <span class="eyebrow">Local government</span>
                    <h2 class="section-title">Working for Stronger Communities</h2>
                    <p class="section-lead">{{ $page['description'] }}</p>
                </div>
                <div class="row g-3 municipal-statistics">
                    @foreach ($page['statistics'] as $statistic)
                        <div class="col-6 col-lg">
                            <article class="municipal-stat h-100">
                                <strong>{{ $statistic['value'] }}</strong>
                                <span>{{ $statistic['label'] }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="row g-4 municipal-priorities">
                    @foreach ($page['priorities'] as $priority)
                        <div class="col-sm-6 col-lg-3">
                            <article class="commitment-card h-100">
                                <i class="fa-solid {{ $priority['icon'] }}" aria-hidden="true"></i>
                                <h3>{{ $priority['title'] }}</h3>
                                <p>{{ $priority['description'] }}</p>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="directory-notice municipal-roster-note">
                    <span class="notice-icon"><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i></span>
                    <div>
                        <span class="eyebrow">Office bearers</span>
                        <h2 class="section-title">Local representatives</h2>
                        <p class="section-lead">A verified roster of municipal and town office bearers is not currently available. Contact the district team for up-to-date committee details.</p>
                        <a class="text-link" href="{{ route('pages.contact') }}">Send an inquiry <i class="fa-solid fa-arrow-right ms-2" aria-hidden="true"></i></a>
                    </div>
                </div>
            @elseif ($page['type'] === 'councils')
                <div class="content-intro text-center">
                    <span class="eyebrow">District Dadu</span>
                    <h2 class="section-title">Union Councils</h2>
                    <p class="section-lead">{{ $page['subtitle'] }}</p>
                </div>
                <div class="row g-3 municipal-statistics council-statistics">
                    @foreach ($page['statistics'] as $statistic)
                        <div class="col-6 col-lg">
                            <article class="municipal-stat h-100">
                                <strong>{{ $statistic['value'] }}</strong>
                                <span>{{ $statistic['label'] }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="row g-4 council-grid">
                    @foreach ($page['councils'] as $index => $council)
                        <div class="col-md-6 col-lg-4">
                            <article class="council-card h-100">
                                <span class="council-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $council['name'] }}</h3>
                                <ul>
                                    @foreach ($council['members'] as $member)
                                        <li><span>{{ $member['role'] }}</span><strong>{{ $member['name'] }}</strong></li>
                                    @endforeach
                                </ul>
                            </article>
                        </div>
                    @endforeach
                </div>
            @elseif ($page['type'] === 'gallery')
                <header class="media-gallery-heading">
                    <h1>{{ $page['title'] }}</h1>
                </header>
                <nav class="media-gallery-filters" aria-label="Filter gallery images">
                    <button class="active" type="button" data-gallery-filter="all" aria-pressed="true">All</button>
                    <button type="button" data-gallery-filter="functions" aria-pressed="false">Functions</button>
                    <button type="button" data-gallery-filter="railes" aria-pressed="false">Railes</button>
                    <button type="button" data-gallery-filter="moments" aria-pressed="false">Moments</button>
                </nav>
                <div class="row g-3 gallery-grid media-gallery-grid">
                    @foreach ($page['images'] as $image)
                        <div class="col-6 col-md-4 col-lg-3 media-gallery-card" data-gallery-category="{{ $image['category'] }}">
                            <a class="gallery-item" href="{{ media_asset($image['file']) }}" data-gallery-image="{{ media_asset($image['file']) }}" data-gallery-alt="{{ $image['alt'] }}" data-bs-toggle="modal" data-bs-target="#galleryModal" aria-label="View {{ $image['alt'] }}">
                                <img src="{{ media_asset($image['file']) }}" alt="{{ $image['alt'] }}" loading="lazy">
                                <span><i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    @endforeach
                </div>
                <section class="page-join-cta media-gallery-cta">
                    <div>
                    <span class="eyebrow">Together for Dadu</span>
                    <h2>Working for Stronger Communities</h2>
                    <p>Join us in building a more peaceful, inclusive and prosperous future for District Dadu.</p>
                    </div>
                    <a class="btn btn-join-light" href="{{ route('pages.join') }}">Join us <i class="fa-solid fa-arrow-right ms-2" aria-hidden="true"></i></a>
                </section>
                <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content gallery-modal-content">
                            <div class="modal-header border-0">
                                <h2 class="modal-title fs-6" id="galleryModalLabel">Pakistan Peoples Party District Dadu</h2>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img class="gallery-modal-image" src="{{ asset('Assets/images/images-8.jpg') }}" alt="Pakistan Peoples Party community activity">
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (($page['layout'] ?? null) === 'membership' || ($page['type'] ?? null) === 'membership')
                @include('pages.membership')
            @elseif ($page['type'] === 'contact')
                <header class="contact-page-heading">
                    <h1>Suggestions/ <span>Complaints/</span> <strong>Contacts</strong></h1>
                </header>
                <div class="contact-layout">
                    <aside class="contact-listening-panel" aria-labelledby="contact-listening-title">
                        <h2 id="contact-listening-title"><span>We are</span> listening</h2>
                        <p>Have a suggestion to improve our services?<br>Facing an issue or have a complaint?<br>Want to get in touch with us?</p>
                        <p class="contact-listening-prompt">Let us know, we are here to help!</p>
                        <ul>
                            @foreach ($page['principles'] as $principle)
                                <li>
                                    <span class="contact-benefit-icon"><i class="fa-solid {{ $principle['icon'] }}" aria-hidden="true"></i></span>
                                    <span><strong>{{ $principle['title'] }}</strong><small>{{ $principle['description'] }}</small></span>
                                </li>
                            @endforeach
                        </ul>
                    </aside>
                    <section class="form-panel contact-form-panel" aria-labelledby="contact-form-title">
                        <h2 id="contact-form-title"><span>Send your</span> Suggestion/ Complaint</h2>
                        <form action="{{ route('pages.contact.store') }}" method="post">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-6"><label class="form-label" for="full_name">Full name <span>*</span></label><input class="form-control" id="full_name" name="full_name" autocomplete="name" required maxlength="150" placeholder="Enter your full name"></div>
                                <div class="col-md-6"><label class="form-label" for="cnic_number">CNIC Number <span>*</span></label><input class="form-control" id="cnic_number" name="cnic_number" inputmode="numeric" placeholder="Enter your CNIC Number" pattern="[0-9]{5}-?[0-9]{7}-?[0-9]" required></div>
                                <div class="col-12"><label class="form-label" for="email_address">Email Address</label><input class="form-control" id="email_address" name="email_address" type="email" autocomplete="email" maxlength="255"></div>
                                <div class="col-12"><label class="form-label" for="phone_number">Phone No</label><input class="form-control" id="phone_number" name="phone_number" type="tel" autocomplete="tel" maxlength="30"></div>
                                <div class="col-12"><label class="form-label" for="contact_type">Select type <span>*</span></label><select class="form-select" id="contact_type" name="contact_type" required><option value="">Select a topic</option><option>Suggestion</option><option>Complaint</option><option>General inquiry</option></select></div>
                                <div class="col-12"><label class="form-label" for="message">Your message/Details <span>*</span></label><textarea class="form-control" id="message" name="message" rows="3" placeholder="Write your Suggestion, Complaint or message here..." required maxlength="5000"></textarea></div>
                                <div class="col-12"><button class="btn contact-submit" type="submit">Submit</button></div>
                            </div>
                        </form>
                    </section>
                </div>
                <section class="membership-impact contact-impact" aria-label="Community impact">
                    <div class="membership-impact-message">
                        <span><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
                        <div><h2>Working for Stronger Communities</h2><p>Our municipal and town bodies are playing a vital role in building a better, cleaner and developed District Dadu. Together we can create a brighter future for our people.</p></div>
                    </div>
                    <ul>
                        <li><i class="fa-solid fa-landmark" aria-hidden="true"></i><span>Better Governance</span></li>
                        <li><i class="fa-solid fa-chart-line" aria-hidden="true"></i><span>Local Development</span></li>
                        <li><i class="fa-solid fa-users" aria-hidden="true"></i><span>Community Support</span></li>
                        <li><i class="fa-solid fa-scale-balanced" aria-hidden="true"></i><span>Public Welfare</span></li>
                    </ul>
                </section>
            @endif

            @unless ($page['type'] === 'membership' || in_array($page['layout'] ?? null, ['president', 'general-secretary', 'district-body', 'leadership', 'union-councils', 'municipal-bodies', 'media-gallery', 'contact'], true))
                <section class="page-join-cta">
                    <div>
                        <span class="eyebrow">Be part of the change</span>
                        <h2>Join hands for a stronger Dadu</h2>
                        <p>Become part of the work for progress, peace and prosperity in our communities.</p>
                    </div>
                    <a class="btn btn-join-light" href="{{ route('pages.join') }}">Join us <i class="fa-solid fa-arrow-right ms-2" aria-hidden="true"></i></a>
                </section>
            @endunless

            @unless (in_array($page['layout'] ?? null, ['president', 'general-secretary', 'district-body', 'leadership', 'union-councils', 'municipal-bodies', 'media-gallery', 'membership', 'contact'], true))
                <nav class="page-directory" aria-label="Other district pages">
                    <span class="eyebrow">Explore more</span>
                    <div>
                        <a href="{{ route('pages.president') }}">About President</a>
                        <a href="{{ route('pages.general-secretary') }}">About General Secretary</a>
                        <a href="{{ route('pages.district-body') }}">District Body</a>
                        <a href="{{ route('pages.municipal-bodies') }}">Municipal &amp; Town Bodies</a>
                        <a href="{{ route('pages.union-council-bodies') }}">Union Council Bodies &amp; Members</a>
                        <a href="{{ route('pages.media-gallery') }}">Media Gallery</a>
                        <a href="{{ route('pages.join') }}">Join Us (Online Membership)</a>
                        <a href="{{ route('pages.contact') }}">Suggestions / Complaints / Contacts</a>
                    </div>
                </nav>
            @endunless
        </div>
    </section>
</main>
@endsection
