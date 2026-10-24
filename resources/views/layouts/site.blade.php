<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Pakistan Peoples Party District Dadu: committed to democracy, social justice and the welfare of the people.' }}">
    <meta name="theme-color" content="#0b603d">
    <title>{{ $title ?? 'Pakistan Peoples Party | District Dadu' }}</title>
    <!-- PWA Manifest & App Icons -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="PPP Dadu">
    <!-- iOS PWA Meta Tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="PPP Dadu">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('pwa/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('pwa/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('pwa/favicon-16x16.png') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ file_exists(public_path('css/site.css')) ? filemtime(public_path('css/site.css')) : time() }}">
</head>
<body>
    <header class="site-header">
        <div class="site-masthead">
            <div class="masthead-inner">
                <a class="masthead-brand" href="{{ route('home') }}" aria-label="Pakistan Peoples Party District Dadu home">
                    <img class="brand-logo" src="{{ asset('Assets/images/PPP-1024x564.png') }}" alt="Pakistan Peoples Party flag emblem">
                    <span class="brand-name">{{ $siteSettings['site.name'] ?? 'Pakistan Peoples Party' }} <small>{{ $siteSettings['site.district'] ?? 'District Dadu' }}</small></span>
                </a>
                <div class="masthead-actions">
                    <button type="button" class="masthead-app-install-btn pwa-trigger-btn" aria-label="Download PPP Dadu Mobile App">
                        <i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i>
                        <span>Download App</span>
                    </button>
                    <a class="masthead-join" href="{{ route('pages.join') }}">
                        <i class="fa-solid fa-people-group" aria-hidden="true"></i>
                        <span>Join PPP</span>
                    </a>
                    <button class="navbar-toggler site-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle site navigation">
                        <i class="fa-solid fa-bars navbar-toggler-icon" aria-hidden="true"></i>
                        <span>Menu</span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="site-menu collapse" id="mainNavigation" aria-label="Main navigation">
            <div class="site-menu-grid">
                <a class="site-menu-item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="fa-solid fa-house" aria-hidden="true"></i><span>Home</span>
                </a>
                <a class="site-menu-item {{ request()->routeIs('pages.leadership') ? 'active' : '' }}" href="{{ route('pages.leadership') }}">
                    <i class="fa-solid fa-users-viewfinder" aria-hidden="true"></i><span>Our Leadership</span>
                </a>

                <div class="site-menu-dropdown dropdown {{ request()->routeIs('pages.president', 'pages.general-secretary') ? 'active' : '' }}">
                    <a class="site-menu-item dropdown-toggle {{ request()->routeIs('pages.president', 'pages.general-secretary') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                        <span>About <i class="fa-solid fa-chevron-down site-dropdown-caret" aria-hidden="true"></i></span>
                    </a>
                    <ul class="dropdown-menu site-dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('pages.president') ? 'active' : '' }}" href="{{ route('pages.president') }}">
                                <i class="fa-solid fa-user-tie" aria-hidden="true"></i>
                                <span>About President</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('pages.general-secretary') ? 'active' : '' }}" href="{{ route('pages.general-secretary') }}">
                                <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                                <span>About General Secretary</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}#profile">
                                <i class="fa-solid fa-bullhorn" aria-hidden="true"></i>
                                <span>About Information Secretary</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="site-menu-dropdown dropdown {{ request()->routeIs('pages.district-body', 'pages.tehsil-bodies', 'pages.municipal-bodies', 'pages.union-council-bodies') ? 'active' : '' }}">
                    <a class="site-menu-item dropdown-toggle {{ request()->routeIs('pages.district-body', 'pages.tehsil-bodies', 'pages.municipal-bodies', 'pages.union-council-bodies') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                        <span>District Body <i class="fa-solid fa-chevron-down site-dropdown-caret" aria-hidden="true"></i></span>
                    </a>
                    <ul class="dropdown-menu site-dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('pages.district-body') ? 'active' : '' }}" href="{{ route('pages.district-body') }}">
                                <i class="fa-solid fa-users" aria-hidden="true"></i>
                                <span>District Body</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('pages.tehsil-bodies') ? 'active' : '' }}" href="{{ route('pages.tehsil-bodies') }}">
                                <i class="fa-solid fa-landmark" aria-hidden="true"></i>
                                <span>Tahseel Bodies</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('pages.municipal-bodies') ? 'active' : '' }}" href="{{ route('pages.municipal-bodies') }}">
                                <i class="fa-solid fa-city" aria-hidden="true"></i>
                                <span>Municipal &amp; Town Bodies</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('pages.union-council-bodies') ? 'active' : '' }}" href="{{ route('pages.union-council-bodies') }}">
                                <i class="fa-solid fa-people-roof" aria-hidden="true"></i>
                                <span>Union Council Bodies</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <a class="site-menu-item {{ request()->routeIs('pages.media-gallery') ? 'active' : '' }}" href="{{ route('pages.media-gallery') }}">
                    <i class="fa-regular fa-image" aria-hidden="true"></i><span>Media Gallery</span>
                </a>
                <a class="site-menu-item {{ request()->routeIs('pages.blogs*') ? 'active' : '' }}" href="{{ route('pages.blogs') }}">
                    <i class="fa-solid fa-newspaper" aria-hidden="true"></i><span>Blogs &amp; News</span>
                </a>
                <a class="site-menu-item {{ request()->routeIs('pages.members') ? 'active' : '' }}" href="{{ route('pages.members') }}">
                    <i class="fa-solid fa-shield-halved" aria-hidden="true"></i><span>Members Area</span>
                </a>
                <a class="site-menu-item {{ request()->routeIs('pages.join') ? 'active' : '' }}" href="{{ route('pages.join') }}">
                    <i class="fa-solid fa-user-group" aria-hidden="true"></i><span>Join PPP (Online Membership)</span>
                </a>
                <a class="site-menu-item {{ request()->routeIs('pages.contact') ? 'active' : '' }}" href="{{ route('pages.contact') }}">
                    <i class="fa-solid fa-comments" aria-hidden="true"></i><span>Suggestions / Complaints / Contacts</span>
                </a>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="site-footer">
        <div class="container">
            <div class="row gy-4 footer-columns">
                <div class="col-lg-4">
                    <a class="footer-brand" href="{{ route('home') }}#home">
                        <img src="{{ asset('Assets/images/PPP-1024x564.png') }}" alt="" loading="lazy">
                        <span>{{ $siteSettings['site.name'] ?? 'Pakistan Peoples Party' }} <small>{{ $siteSettings['site.district'] ?? 'District Dadu' }}</small></span>
                    </a>
                    <p class="footer-message">{{ $siteSettings['site.tagline'] ?? 'Committed to democracy, social justice and the welfare of the people.' }}</p>
                </div>
                <div class="col-lg-4">
                    <h2 class="footer-heading">Pages</h2>
                    <nav class="footer-nav" aria-label="Footer navigation">
                        <a href="{{ route('pages.leadership') }}">Our Leadership</a>
                        <a href="{{ route('pages.president') }}">About President</a>
                        <a href="{{ route('pages.general-secretary') }}">About General Secretary</a>
                        <a href="{{ route('pages.district-body') }}">District Body</a>
                        <a href="{{ route('pages.tehsil-bodies') }}">Tahseel Bodies</a>
                        <a href="{{ route('pages.municipal-bodies') }}">Municipal &amp; Town Bodies</a>
                        <a href="{{ route('pages.union-council-bodies') }}">Union Council Bodies</a>
                        <a href="{{ route('pages.media-gallery') }}">Media Gallery</a>
                        <a href="{{ route('pages.blogs') }}">Blogs &amp; News</a>
                        <a href="{{ route('pages.members') }}">Members Area</a>
                    </nav>
                </div>
                <div class="col-lg-4">
                    <h2 class="footer-heading">Get involved</h2>
                    <p class="footer-message">Join our community and take part in building a better future for District Dadu.</p>
                    <a class="footer-join-link" href="{{ route('pages.join') }}">Join Us <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    <a class="footer-contact-link" href="{{ route('pages.contact') }}">Suggestions, complaints &amp; contact</a>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; <span data-current-year>2026</span> {{ $siteSettings['site.name'] ?? 'Pakistan Peoples Party' }} {{ $siteSettings['site.district'] ?? 'District Dadu' }}</span>
                <div class="footer-bottom-links">
                    <a href="javascript:void(0)" class="pwa-trigger-btn me-3"><i class="fa-solid fa-mobile-screen-button me-1" aria-hidden="true"></i> Download App</a>
                    <a href="{{ route('admin.dashboard') }}" class="footer-admin-link me-3"><i class="fa-solid fa-lock" aria-hidden="true"></i> Admin Panel</a>
                    <a href="{{ route('home') }}#home">Back to top <i class="fa-solid fa-arrow-up ms-1" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- PWA Download / Installation Modal -->
    <div class="modal fade" id="pwaModal" tabindex="-1" aria-labelledby="pwaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="pwa-modal-header d-flex justify-content-between align-items-center">
                    <div class="pwa-app-badge-box">
                        <img src="{{ asset('pwa/icon-192x192.png') }}" alt="PPP Dadu Logo" class="pwa-app-logo">
                        <div class="pwa-app-info">
                            <h4 id="pwaModalLabel">PPP District Dadu</h4>
                            <p>Official Mobile Application</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Feature Pills -->
                    <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                        <span class="pwa-feature-pill"><i class="fa-solid fa-bolt text-warning"></i> Fast Performance</span>
                        <span class="pwa-feature-pill"><i class="fa-solid fa-wifi text-success"></i> Offline Reading</span>
                        <span class="pwa-feature-pill"><i class="fa-solid fa-bell text-danger"></i> Latest Party News</span>
                    </div>

                    <!-- Platform Selector Tabs -->
                    <div class="d-flex gap-2 mb-3" role="tablist">
                        <button type="button" class="pwa-platform-tab-btn active" id="pwaAndroidTab" data-platform="android">
                            <i class="fa-brands fa-android fs-5 text-success"></i>
                            <span>Android</span>
                        </button>
                        <button type="button" class="pwa-platform-tab-btn" id="pwaIosTab" data-platform="ios">
                            <i class="fa-brands fa-apple fs-5"></i>
                            <span>iPhone / iOS</span>
                        </button>
                    </div>

                    <!-- Android Panel -->
                    <div id="pwaAndroidPanel" class="pwa-platform-content">
                        <div class="text-center py-3">
                            <p class="text-muted small mb-3">
                                Tap the button below to install the official PPP Dadu app directly to your home screen with zero app store hassle.
                            </p>
                            <button type="button" class="btn btn-success btn-lg px-4 py-2 fw-bold w-100 shadow-sm" id="pwaNativeInstallBtn">
                                <i class="fa-brands fa-android me-2"></i> Install on Android
                            </button>
                            <div class="small text-muted mt-3">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> Works on Chrome, Samsung Internet, Brave &amp; Edge
                            </div>
                        </div>
                    </div>

                    <!-- iOS Panel -->
                    <div id="pwaIosPanel" class="pwa-platform-content d-none">
                        <p class="text-muted small mb-3 text-center">
                            Follow these 3 quick steps in <strong>Safari</strong> on your iPhone or iPad:
                        </p>
                        <div class="pwa-ios-step">
                            <div class="pwa-ios-step-num">1</div>
                            <div class="pwa-ios-step-text">
                                In <strong>Safari</strong>, tap the <strong>Share</strong> button <span class="pwa-ios-pill"><i class="fa-solid fa-arrow-up-from-bracket text-primary"></i></span> in the bottom toolbar.
                            </div>
                        </div>
                        <div class="pwa-ios-step">
                            <div class="pwa-ios-step-num">2</div>
                            <div class="pwa-ios-step-text">
                                Scroll down the menu and tap <span class="pwa-ios-pill"><i class="fa-solid fa-square-plus text-success"></i> Add to Home Screen</span>.
                            </div>
                        </div>
                        <div class="pwa-ios-step">
                            <div class="pwa-ios-step-num">3</div>
                            <div class="pwa-ios-step-text">
                                Tap <span class="pwa-ios-pill fw-bold">Add</span> in the top-right corner. The PPP Dadu icon will appear on your Home Screen!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3 justify-content-between border-top">
                    <span class="small text-muted"><i class="fa-solid fa-shield-halved text-success me-1"></i> Safe &amp; Verified Official App</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('Assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('Assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/site.js') }}?v={{ file_exists(public_path('js/site.js')) ? filemtime(public_path('js/site.js')) : time() }}"></script>
</body>
</html>
