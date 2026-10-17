@extends('layouts.admin', [
    'title' => 'Suggestions & Complaints',
    'pageTitle' => 'Submissions &bull; Public Suggestions, Complaints &amp; Contacts'
])

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <!-- Filter Tabs -->
    <div class="d-flex flex-wrap gap-2">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.submissions.contacts', ['status' => 'all', 'type' => $type]) }}" class="btn btn-sm {{ $status === 'all' ? 'btn-success' : 'btn-outline-secondary' }}">
                All
            </a>
            <a href="{{ route('admin.submissions.contacts', ['status' => 'new', 'type' => $type]) }}" class="btn btn-sm {{ $status === 'new' ? 'btn-danger' : 'btn-outline-secondary' }}">
                <i class="fa-solid fa-bell me-1"></i> New
            </a>
            <a href="{{ route('admin.submissions.contacts', ['status' => 'reviewed', 'type' => $type]) }}" class="btn btn-sm {{ $status === 'reviewed' ? 'btn-primary' : 'btn-outline-secondary' }}">
                Reviewed
            </a>
            <a href="{{ route('admin.submissions.contacts', ['status' => 'resolved', 'type' => $type]) }}" class="btn btn-sm {{ $status === 'resolved' ? 'btn-success' : 'btn-outline-secondary' }}">
                Resolved
            </a>
        </div>

        <div class="btn-group" role="group">
            <a href="{{ route('admin.submissions.contacts', ['status' => $status, 'type' => 'all']) }}" class="btn btn-sm {{ $type === 'all' ? 'btn-dark' : 'btn-outline-secondary' }}">All Types</a>
            <a href="{{ route('admin.submissions.contacts', ['status' => $status, 'type' => 'Complaint']) }}" class="btn btn-sm {{ $type === 'Complaint' ? 'btn-dark' : 'btn-outline-secondary' }}">Complaints</a>
            <a href="{{ route('admin.submissions.contacts', ['status' => $status, 'type' => 'Suggestion']) }}" class="btn btn-sm {{ $type === 'Suggestion' ? 'btn-dark' : 'btn-outline-secondary' }}">Suggestions</a>
        </div>
    </div>

    <!-- Search Box -->
    <form action="{{ route('admin.submissions.contacts') }}" method="GET" class="d-flex gap-2">
        <input type="hidden" name="status" value="{{ $status }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="input-group input-group-sm" style="width: 250px;">
            <input type="text" name="search" class="form-control" placeholder="Search message or sender..." value="{{ $search }}">
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
                    <th>Sender</th>
                    <th>Type</th>
                    <th>CNIC</th>
                    <th>Message Snippet</th>
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
                            <strong class="text-dark">{{ $p['full_name'] ?? 'N/A' }}</strong>
                            <div class="text-muted small">{{ $p['email_address'] ?? $p['phone_number'] ?? '' }}</div>
                        </td>
                        <td>
                            @if (($p['contact_type'] ?? '') === 'Complaint')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Complaint</span>
                            @elseif (($p['contact_type'] ?? '') === 'Suggestion')
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Suggestion</span>
                            @else
                                <span class="badge bg-light text-dark border">General</span>
                            @endif
                        </td>
                        <td><code>{{ $p['cnic_number'] ?? 'N/A' }}</code></td>
                        <td>
                            <span class="text-truncate d-inline-block" style="max-width: 260px;">
                                {{ $p['message'] ?? '' }}
                            </span>
                        </td>
                        <td>
                            <span class="admin-badge admin-badge-{{ $sub->status ?? 'new' }}">
                                {{ ucfirst($sub->status ?? 'new') }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modalContact{{ $sub->id }}">
                                <i class="fa-solid fa-envelope-open-text me-1"></i> Read
                            </button>
                            <form action="{{ route('admin.submissions.destroy', $sub) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Detail Modal -->
                    <div class="modal fade" id="modalContact{{ $sub->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $sub->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="modalLabel{{ $sub->id }}">
                                        <i class="fa-solid fa-message text-success me-2"></i>
                                        {{ $p['contact_type'] ?? 'Message' }} from {{ $p['full_name'] ?? 'Citizen' }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="text-muted small">Sender Name</label>
                                            <div class="fw-bold fs-6">{{ $p['full_name'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">CNIC Number</label>
                                            <div class="fw-bold font-monospace">{{ $p['cnic_number'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Phone / Mobile</label>
                                            <div>{{ $p['phone_number'] ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="text-muted small">Email Address</label>
                                            <div>{{ $p['email_address'] ?? 'N/A' }}</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-muted small">Full Message</label>
                                        <div class="p-3 bg-light rounded border text-dark fs-6" style="white-space: pre-line;">{{ $p['message'] ?? 'No message text.' }}</div>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Status Update -->
                                    <form action="{{ route('admin.submissions.status', $sub) }}" method="POST" class="d-flex align-items-center justify-content-between">
                                        @csrf
                                        @method('PATCH')
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="fw-bold small mb-0">Update Status:</label>
                                            <select name="status" class="form-select form-select-sm w-auto">
                                                <option value="new" {{ ($sub->status ?? 'new') === 'new' ? 'selected' : '' }}>New</option>
                                                <option value="reviewed" {{ ($sub->status ?? '') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                                <option value="resolved" {{ ($sub->status ?? '') === 'resolved' ? 'selected' : '' }}>Resolved</option>
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
                            <i class="fa-solid fa-inbox fa-3x mb-3 d-block text-muted"></i>
                            No messages found matching criteria.
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
