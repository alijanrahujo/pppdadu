<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} | PPP District Dadu</title>
    <link rel="stylesheet" href="{{ asset('Assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <img src="{{ asset('Assets/images/PPP-1024x564.png') }}" alt="PPP Logo">
                <div class="admin-brand-copy">
                    <span class="admin-brand-title">PPP Dadu</span>
                    <span class="admin-brand-badge">Content Manager</span>
                </div>
            </a>

            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="admin-nav-section">Site Settings</li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.settings.general') }}" class="admin-nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                        <i class="fa-solid fa-sliders"></i>
                        <span>General &amp; Social</span>
                    </a>
                </li>

                <li class="admin-nav-section">Homepage Management</li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.home.hero') }}" class="admin-nav-link {{ request()->routeIs('admin.home.hero') ? 'active' : '' }}">
                        <i class="fa-solid fa-video"></i>
                        <span>Hero Section</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.home.values') }}" class="admin-nav-link {{ request()->routeIs('admin.home.values') ? 'active' : '' }}">
                        <i class="fa-solid fa-heart-pulse"></i>
                        <span>Party Values Strip</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.home.profile') }}" class="admin-nav-link {{ request()->routeIs('admin.home.profile') ? 'active' : '' }}">
                        <i class="fa-solid fa-id-badge"></i>
                        <span>Info Secretary Profile</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.home.about') }}" class="admin-nav-link {{ request()->routeIs('admin.home.about') ? 'active' : '' }}">
                        <i class="fa-solid fa-landmark"></i>
                        <span>About PPP Section</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.home.join') }}" class="admin-nav-link {{ request()->routeIs('admin.home.join') ? 'active' : '' }}">
                        <i class="fa-solid fa-handshake"></i>
                        <span>Join Callout Banner</span>
                    </a>
                </li>

                <li class="admin-nav-section">Leadership &amp; Org</li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.leaders.index') }}" class="admin-nav-link {{ request()->routeIs('admin.leaders.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Leaders &amp; Bearers</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.councils.index') }}" class="admin-nav-link {{ request()->routeIs('admin.councils.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-sitemap"></i>
                        <span>Union Councils</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.tehsil-bodies') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.tehsil-bodies') ? 'active' : '' }}">
                        <i class="fa-solid fa-landmark"></i>
                        <span>Tehsil Bodies</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.municipal-bodies') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.municipal-bodies') ? 'active' : '' }}">
                        <i class="fa-solid fa-city"></i>
                        <span>Municipal Bodies</span>
                    </a>
                </li>

                <li class="admin-nav-section">Page Profiles</li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.president') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.president') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-tie"></i>
                        <span>About President</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.general-secretary') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.general-secretary') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-pen"></i>
                        <span>About Gen. Secretary</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.leadership') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.leadership') ? 'active' : '' }}">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        <span>Our Leadership Page</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.district-body') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.district-body') ? 'active' : '' }}">
                        <i class="fa-solid fa-building-columns"></i>
                        <span>District Body Text</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.join') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.join') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-card"></i>
                        <span>Join Page Text</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pages.contact') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.contact') ? 'active' : '' }}">
                        <i class="fa-solid fa-comments"></i>
                        <span>Contact Page Text</span>
                    </a>
                </li>

                <li class="admin-nav-section">Media &amp; Submissions</li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.blogs.index') }}" class="admin-nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Blogs &amp; News</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.gallery.index') }}" class="admin-nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <i class="fa-regular fa-images"></i>
                        <span>Media Gallery</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.submissions.memberships') }}" class="admin-nav-link {{ request()->routeIs('admin.submissions.memberships') ? 'active' : '' }}">
                        <i class="fa-solid fa-id-card-clip"></i>
                        <span>Memberships</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.submissions.contacts') }}" class="admin-nav-link {{ request()->routeIs('admin.submissions.contacts') ? 'active' : '' }}">
                        <i class="fa-solid fa-inbox"></i>
                        <span>Suggestions / Contact</span>
                    </a>
                </li>
            </ul>

            <div class="admin-sidebar-footer">
                <a href="{{ route('admin.profile.edit') }}" class="admin-user-pill">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="admin-user-info">
                        <div class="admin-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="admin-user-role">Administrator</div>
                    </div>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-link text-white-50 p-1" title="Log Out" aria-label="Log Out">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </aside>
        <div class="admin-sidebar-backdrop" id="sidebarBackdrop"></div>

        <!-- Main content area -->
        <div class="admin-main">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button type="button" class="admin-topbar-toggle" id="sidebarToggle" aria-label="Toggle navigation menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1 class="admin-page-title">{{ $pageTitle ?? 'Dashboard' }}</h1>
                </div>
                <div class="admin-topbar-right">
                    <a href="{{ route('home') }}" target="_blank" class="admin-btn-live">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        <span>View Live Website</span>
                    </a>
                </div>
            </header>

            <main class="admin-content">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                        <strong>Please check the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('Assets/js/jquery.min.js') }}"></script>
    <script>window.$ = window.jQuery;</script>
    <script src="{{ asset('Assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(function () {
            // Sidebar toggle for mobile/tablet
            $('#sidebarToggle, #sidebarBackdrop').on('click', function () {
                $('#adminSidebar').toggleClass('show');
            });

            // Auto-preview image inputs
            $('input[type="file"][data-preview]').each(function () {
                const input = this;
                const targetId = $(input).data('preview');
                $(input).on('change', function () {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $('#' + targetId).attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
