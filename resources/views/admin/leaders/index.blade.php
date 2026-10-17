@extends('layouts.admin', [
    'title' => 'Leaders & Bearers',
    'pageTitle' => 'Leaders &bull; Leadership Slider &amp; District Body'
])

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <!-- Category Filter Tabs -->
    <div class="btn-group" role="group">
        <a href="{{ route('admin.leaders.index', ['category' => 'all']) }}" class="btn btn-sm {{ $category === 'all' ? 'btn-success' : 'btn-outline-secondary' }}">
            All ({{ \App\Models\Leader::count() }})
        </a>
        <a href="{{ route('admin.leaders.index', ['category' => 'central_leadership']) }}" class="btn btn-sm {{ $category === 'central_leadership' ? 'btn-success' : 'btn-outline-secondary' }}">
            <i class="fa-solid fa-star me-1"></i> Central ({{ \App\Models\Leader::where('category', 'central_leadership')->count() }})
        </a>
        <a href="{{ route('admin.leaders.index', ['category' => 'leadership_slider']) }}" class="btn btn-sm {{ $category === 'leadership_slider' ? 'btn-success' : 'btn-outline-secondary' }}">
            <i class="fa-solid fa-sliders me-1"></i> Home Slider ({{ \App\Models\Leader::where('category', 'leadership_slider')->count() }})
        </a>
        <a href="{{ route('admin.leaders.index', ['category' => 'district_body']) }}" class="btn btn-sm {{ $category === 'district_body' ? 'btn-success' : 'btn-outline-secondary' }}">
            <i class="fa-solid fa-users me-1"></i> District Body ({{ \App\Models\Leader::where('category', 'district_body')->count() }})
        </a>
    </div>

    <a href="{{ route('admin.leaders.create', ['category' => $category === 'all' ? 'leadership_slider' : $category]) }}" class="admin-btn admin-btn-primary">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Leader</span>
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">Photo</th>
                    <th>Name</th>
                    <th>Designation / Role</th>
                    <th>Section</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaders as $leader)
                    <tr>
                        <td>
                            <img src="{{ $leader->image_url }}" alt="{{ $leader->name }}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                        </td>
                        <td>
                            <strong class="d-block text-dark">{{ $leader->name }}</strong>
                            <span class="text-muted small">{{ $leader->district }}</span>
                        </td>
                        <td>{{ $leader->role }}</td>
                        <td>
                            @if ($leader->category === 'central_leadership')
                                <span class="badge bg-danger">Central</span>
                            @elseif ($leader->category === 'leadership_slider')
                                <span class="badge bg-primary">Home Slider</span>
                            @else
                                <span class="badge bg-dark">District Body</span>
                            @endif
                        </td>
                        <td>{{ $leader->order }}</td>
                        <td>
                            @if ($leader->is_active)
                                <span class="badge bg-success-subtle text-success">Active</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.leaders.edit', $leader) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.leaders.destroy', $leader) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete leader {{ $leader->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-users fa-3x mb-3 d-block text-muted"></i>
                            No leaders found in this category.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($leaders->hasPages())
        <div class="p-3 border-top d-flex justify-content-end">
            {{ $leaders->links() }}
        </div>
    @endif
</div>
@endsection
