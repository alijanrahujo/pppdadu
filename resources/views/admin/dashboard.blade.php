@extends('layouts.admin', [
    'title' => 'Dashboard',
    'pageTitle' => 'District Dadu &bull; Content Management Dashboard'
])

@section('content')
<!-- Welcome Banner -->
<div class="admin-card mb-4" style="background: linear-gradient(135deg, #0b603d 0%, #07452b 100%); color: #fff; border: none;">
    <div class="admin-card-body d-flex flex-wrap align-items-center justify-content-between gap-3 p-4">
        <div>
            <h2 class="h4 fw-bold mb-1">Welcome to PPP District Dadu Website Manager</h2>
            <p class="mb-0 text-white-50 fs-6">Manage all homepage sections, leadership, union councils, gallery photos, and public submissions dynamically.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.home.hero') }}" class="btn btn-warning fw-bold text-dark btn-sm">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Homepage
            </a>
            <a href="{{ route('admin.leaders.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fa-solid fa-users me-1"></i> Manage Leaders
            </a>
        </div>
    </div>
</div>

<!-- Quick Statistics -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('admin.submissions.memberships') }}" class="text-decoration-none">
            <div class="admin-stat-card">
                <div class="admin-stat-icon green">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div class="admin-stat-copy">
                    <div class="admin-stat-value">{{ $membershipCount }}</div>
                    <div class="admin-stat-label">Online Memberships</div>
                    @if ($newMembershipCount > 0)
                        <span class="badge bg-warning text-dark mt-1">{{ $newMembershipCount }} Pending</span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('admin.submissions.contacts') }}" class="text-decoration-none">
            <div class="admin-stat-card">
                <div class="admin-stat-icon red">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div class="admin-stat-copy">
                    <div class="admin-stat-value">{{ $contactCount }}</div>
                    <div class="admin-stat-label">Suggestions / Complaints</div>
                    @if ($newContactCount > 0)
                        <span class="badge bg-danger mt-1">{{ $newContactCount }} New</span>
                    @endif
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none">
            <div class="admin-stat-card">
                <div class="admin-stat-icon gold">
                    <i class="fa-solid fa-images"></i>
                </div>
                <div class="admin-stat-copy">
                    <div class="admin-stat-value">{{ $galleryCount }}</div>
                    <div class="admin-stat-label">Media Gallery Photos</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="{{ route('admin.leaders.index') }}" class="text-decoration-none">
            <div class="admin-stat-card">
                <div class="admin-stat-icon blue">
                    <i class="fa-solid fa-sitemap"></i>
                </div>
                <div class="admin-stat-copy">
                    <div class="admin-stat-value">{{ $leaderCount }} Leaders / {{ $councilCount }} UCs</div>
                    <div class="admin-stat-label">Organization Structure</div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Quick Navigation Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-house"></i> Homepage Sections</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.home.hero') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-video me-2 text-success"></i> Hero Section &amp; Background</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.home.profile') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-id-badge me-2 text-success"></i> Deputy Info Secretary Profile</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.home.about') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-landmark me-2 text-success"></i> About PPP Section &amp; Statistics</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.home.values') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-heart-pulse me-2 text-success"></i> Party Values Strip</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-users-gear"></i> Leadership &amp; Profiles</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.pages.president') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-user-tie me-2 text-primary"></i> About President Profile</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.pages.general-secretary') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-user-pen me-2 text-primary"></i> About General Secretary</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.leaders.index', ['category' => 'leadership_slider']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-sliders me-2 text-primary"></i> Home Leadership Carousel</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.leaders.index', ['category' => 'district_body']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-users me-2 text-primary"></i> District Body Office Bearers</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-globe"></i> Organization &amp; Media</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.councils.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-sitemap me-2 text-warning"></i> Union Councils (UCs)</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.pages.municipal-bodies') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-city me-2 text-warning"></i> Municipal &amp; Town Bodies</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-images me-2 text-warning"></i> Media Gallery Photos</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    <a href="{{ route('admin.settings.general') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="fa-solid fa-gear me-2 text-warning"></i> Site &amp; Social Settings</span>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Submissions Overview -->
<div class="row g-4">
    <!-- Recent Memberships -->
    <div class="col-lg-6">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-id-card-clip"></i> Recent Membership Applications</h3>
                <a href="{{ route('admin.submissions.memberships') }}" class="btn btn-sm btn-outline-secondary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>CNIC</th>
                            <th>City / District</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentMemberships as $item)
                            @php $p = $item->payload ?? []; @endphp
                            <tr>
                                <td>
                                    <strong>{{ $p['full_name'] ?? 'N/A' }}</strong>
                                    <div class="text-muted small">{{ $p['mobile_number'] ?? $p['phone_number'] ?? '' }}</div>
                                </td>
                                <td><code>{{ $p['cnic_number'] ?? 'N/A' }}</code></td>
                                <td>{{ $p['city'] ?? $p['district'] ?? 'Dadu' }}</td>
                                <td>
                                    <span class="admin-badge admin-badge-{{ $item->status ?? 'new' }}">
                                        {{ ucfirst($item->status ?? 'new') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block text-muted"></i>
                                    No membership applications received yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-lg-6">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-inbox"></i> Recent Suggestions &amp; Complaints</h3>
                <a href="{{ route('admin.submissions.contacts') }}" class="btn btn-sm btn-outline-secondary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentContacts as $item)
                            @php $p = $item->payload ?? []; @endphp
                            <tr>
                                <td>
                                    <strong>{{ $p['full_name'] ?? 'N/A' }}</strong>
                                    <div class="text-muted small">{{ $p['email_address'] ?? $p['phone_number'] ?? '' }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $p['contact_type'] ?? 'General' }}</span>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 180px;">
                                        {{ $p['message'] ?? '' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="admin-badge admin-badge-{{ $item->status ?? 'new' }}">
                                        {{ ucfirst($item->status ?? 'new') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block text-muted"></i>
                                    No contact messages received yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
