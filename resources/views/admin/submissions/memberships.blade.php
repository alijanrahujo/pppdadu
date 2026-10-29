@extends('layouts.admin', [
    'title' => 'Online Memberships',
    'pageTitle' => 'Submissions &bull; Online Membership Applications'
])

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <!-- Filter Tabs -->
    <div class="btn-group" role="group">
        <a href="{{ route('admin.submissions.memberships', ['status' => 'all']) }}" class="btn btn-sm {{ $status === 'all' ? 'btn-success' : 'btn-outline-secondary' }}">
            All
        </a>
        <a href="{{ route('admin.submissions.memberships', ['status' => 'new']) }}" class="btn btn-sm {{ $status === 'new' ? 'btn-warning text-dark' : 'btn-outline-secondary' }}">
            <i class="fa-solid fa-clock me-1"></i> Pending
        </a>
        <a href="{{ route('admin.submissions.memberships', ['status' => 'approved']) }}" class="btn btn-sm {{ $status === 'approved' ? 'btn-success' : 'btn-outline-secondary' }}">
            <i class="fa-solid fa-circle-check me-1"></i> Approved
        </a>
        <a href="{{ route('admin.submissions.memberships', ['status' => 'rejected']) }}" class="btn btn-sm {{ $status === 'rejected' ? 'btn-danger' : 'btn-outline-secondary' }}">
            <i class="fa-solid fa-ban me-1"></i> Rejected
        </a>
    </div>

    <!-- Search Box -->
    <form action="{{ route('admin.submissions.memberships') }}" method="GET" class="d-flex gap-2">
        <input type="hidden" name="status" value="{{ $status }}">
        <div class="input-group input-group-sm" style="width: 260px;">
            <input type="text" name="search" class="form-control" placeholder="Search by name, CNIC, phone..." value="{{ $search }}">
            <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Applicant</th>
                    <th>CNIC</th>
                    <th>Phone / Mobile</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($submissions as $sub)
                    @php $p = $sub->payload ?? []; @endphp
                    <tr>
                        <td>
                            <small class="text-muted">{{ $sub->created_at->format('M d, Y') }}</small>
                            <div class="text-muted" style="font-size: 11px;">{{ $sub->created_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if (!empty($p['profile_picture']))
                                    <img src="{{ asset('storage/' . $p['profile_picture']) }}" alt="Photo" class="rounded-circle border" style="width: 38px; height: 38px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 38px; height: 38px; font-size: 14px;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                                <div>
                                    <strong class="text-dark">{{ $p['full_name'] ?? trim(($p['first_name'] ?? '').' '.($p['last_name'] ?? '')) ?: 'N/A' }}</strong>
                                    <div>
                                        @if (!empty($p['member_type']))
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size: 10px;">{{ $p['member_type'] }}</span>
                                        @endif
                                        @if (!empty($p['gender']))
                                            <span class="badge bg-light text-secondary border ms-1" style="font-size: 10px;">{{ $p['gender'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><code>{{ $p['cnic_number'] ?? 'N/A' }}</code></td>
                        <td>{{ $p['mobile_number'] ?? $p['phone_number'] ?? 'N/A' }}</td>
                        <td>{{ $p['tehsil_city'] ?? $p['city'] ?? $p['district'] ?? 'District Dadu' }}</td>
                        <td>
                            <span class="admin-badge admin-badge-{{ $sub->status ?? 'new' }}">
                                {{ ucfirst($sub->status ?? 'new') }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modalSub{{ $sub->id }}">
                                <i class="fa-solid fa-eye me-1"></i> View Details
                            </button>
                            <form action="{{ route('admin.submissions.memberships.destroy', $sub) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this application record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Application Detail Modal -->
                    <div class="modal fade" id="modalSub{{ $sub->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $sub->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="modalLabel{{ $sub->id }}">
                                        <i class="fa-solid fa-id-card text-danger me-2"></i>
                                        Membership Application #{{ $sub->id }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <!-- Header with Photo and Name -->
                                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded border mb-4">
                                        @if (!empty($p['profile_picture']))
                                            <img src="{{ asset('storage/' . $p['profile_picture']) }}" alt="Photo" class="rounded border shadow-sm" style="width: 72px; height: 72px; object-fit: cover;">
                                        @else
                                            <div class="rounded bg-white border d-flex align-items-center justify-content-center text-muted" style="width: 72px; height: 72px; font-size: 28px;">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="mb-1 text-dark fw-bold">{{ $p['full_name'] ?? trim(($p['first_name'] ?? '').' '.($p['last_name'] ?? '')) ?: 'N/A' }}</h4>
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <span class="badge bg-danger">{{ $p['member_type'] ?? 'General Member' }}</span>
                                                <span class="badge bg-secondary">{{ $p['resident_type'] ?? 'Pakistani' }}</span>
                                                <span class="badge bg-light text-dark border">{{ $p['gender'] ?? 'N/A' }}</span>
                                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>Applied: {{ $sub->created_at->format('M d, Y h:i A') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="text-muted small">First Name</label>
                                            <div class="fw-bold">{{ $p['first_name'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Last Name</label>
                                            <div class="fw-bold">{{ $p['last_name'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">CNIC Number</label>
                                            <div class="fw-bold fs-6 font-monospace text-primary">{{ $p['cnic_number'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Date of Birth</label>
                                            <div class="fw-bold">{{ $p['date_of_birth'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Mobile Number</label>
                                            <div class="fw-bold text-success">{{ $p['mobile_number'] ?? $p['phone_number'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Email Address</label>
                                            <div>{{ $p['email_address'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Education</label>
                                            <div>{{ $p['education'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Profession</label>
                                            <div>{{ $p['profession'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="text-muted small">Province</label>
                                            <div>{{ $p['province'] ?? 'Sindh' }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="text-muted small">Division</label>
                                            <div>{{ $p['division'] ?? 'Hyderabad' }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="text-muted small">District</label>
                                            <div>{{ $p['district'] ?? 'Dadu' }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="text-muted small">Tehsil / City</label>
                                            <div>{{ $p['tehsil_city'] ?? $p['city'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="text-muted small">Current Address</label>
                                            <div class="p-2 bg-light rounded border">{{ $p['current_address'] ?? $p['address'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="text-muted small">Permanent Address</label>
                                            <div class="p-2 bg-light rounded border">{{ $p['permanent_address'] ?? $p['address'] ?? 'N/A' }}</div>
                                        </div>

                                        @if (!empty($p['facebook_url']) || !empty($p['twitter_url']) || !empty($p['instagram_url']) || !empty($p['tiktok_url']))
                                            <div class="col-12">
                                                <label class="text-muted small d-block mb-1">Social Media Profiles</label>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if (!empty($p['facebook_url']))
                                                        <a href="{{ $p['facebook_url'] }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary"><i class="fa-brands fa-facebook me-1"></i> Facebook</a>
                                                    @endif
                                                    @if (!empty($p['twitter_url']))
                                                        <a href="{{ $p['twitter_url'] }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-dark"><i class="fa-brands fa-x-twitter me-1"></i> Twitter</a>
                                                    @endif
                                                    @if (!empty($p['instagram_url']))
                                                        <a href="{{ $p['instagram_url'] }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-danger"><i class="fa-brands fa-instagram me-1"></i> Instagram</a>
                                                    @endif
                                                    @if (!empty($p['tiktok_url']))
                                                        <a href="{{ $p['tiktok_url'] }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-dark"><i class="fa-brands fa-tiktok me-1"></i> TikTok</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if (!empty($p['volunteering']) && is_array($p['volunteering']))
                                            <div class="col-12">
                                                <label class="text-muted small d-block mb-1">Volunteering Preferences</label>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($p['volunteering'] as $pref)
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle p-2">{{ $pref }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <hr class="my-4">

                                    <!-- Status Update -->
                                    <form action="{{ route('admin.submissions.memberships.status', $sub) }}" method="POST" class="d-flex align-items-center justify-content-between">
                                        @csrf
                                        @method('PATCH')
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="fw-bold small mb-0">Update Status:</label>
                                            <select name="status" class="form-select form-select-sm w-auto">
                                                <option value="new" {{ ($sub->status ?? 'new') === 'new' ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ ($sub->status ?? '') === 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ ($sub->status ?? '') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-id-card-clip fa-3x mb-3 d-block text-muted"></i>
                            No membership applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($submissions->hasPages())
        <div class="p-3 border-top d-flex justify-content-end">
            {{ $submissions->links() }}
        </div>
    @endif
</div>
@endsection
