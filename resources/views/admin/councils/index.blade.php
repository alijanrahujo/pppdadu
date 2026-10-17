@extends('layouts.admin', [
    'title' => 'Union Councils',
    'pageTitle' => 'Organization &bull; Union Councils &amp; Office Bearers'
])

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <p class="text-muted mb-0">Manage grassroots Union Councils and their local office bearers (Chairman, Vice Chairman, etc.)</p>
    <a href="{{ route('admin.councils.create') }}" class="admin-btn admin-btn-primary">
        <i class="fa-solid fa-plus"></i>
        <span>Add Union Council</span>
    </a>
</div>

<div class="row g-4">
    @forelse ($councils as $council)
        <div class="col-md-6 col-xl-4">
            <div class="admin-card h-100 d-flex flex-column">
                <div class="position-relative">
                    <img src="{{ $council->image_url }}" alt="{{ $council->name }}" class="w-100" style="height: 160px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75">Order: {{ $council->order }}</span>
                </div>
                <div class="admin-card-body flex-grow-1">
                    <h3 class="h5 fw-bold text-dark mb-2">{{ $council->name }}</h3>
                    <div class="text-muted small mb-3">
                        <i class="fa-solid fa-users me-1 text-success"></i>
                        {{ count($council->members ?? []) }} Committee Bearers
                    </div>

                    <div class="border-top pt-2">
                        @foreach (array_slice($council->members ?? [], 0, 4) as $m)
                            <div class="d-flex align-items-center justify-content-between py-1 border-bottom border-light small">
                                <span class="fw-semibold text-secondary">{{ $m['role'] ?? 'Member' }}:</span>
                                <span class="text-dark">{{ $m['name'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer bg-light justify-content-between">
                    <span class="text-muted small">ID: #{{ $council->id }}</span>
                    <div>
                        <a href="{{ route('admin.councils.edit', $council) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.councils.destroy', $council) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete union council {{ $council->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="admin-card text-center py-5">
                <i class="fa-solid fa-sitemap fa-3x text-muted mb-3 d-block"></i>
                <h4 class="h5 text-muted">No Union Councils Added Yet</h4>
                <p class="text-muted">Click the button above to add your first Union Council.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
