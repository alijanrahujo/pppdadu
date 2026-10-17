@extends('layouts.admin', [
    'title' => ($council->exists ? 'Edit UC: ' . $council->name : 'Add Union Council'),
    'pageTitle' => ($council->exists ? 'Edit UC &bull; ' . $council->name : 'Add Union Council')
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ $council->exists ? route('admin.councils.update', $council) : route('admin.councils.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($council->exists)
                @method('PUT')
            @endif

            <!-- Basic Council Details -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <h2 class="admin-card-title">
                        <i class="fa-solid fa-landmark"></i>
                        {{ $council->exists ? 'Edit Union Council' : 'New Union Council Information' }}
                    </h2>
                    <a href="{{ route('admin.councils.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Councils
                    </a>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="admin-form-group">
                                <label for="name" class="admin-label">Union Council Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" class="admin-input" value="{{ old('name', $council->name) }}" required placeholder="e.g. UC Khairpur Nathan Shah">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="admin-form-group">
                                <label for="order" class="admin-label">Display Order</label>
                                <input type="number" id="order" name="order" class="admin-input" value="{{ old('order', $council->order ?? 0) }}" min="0">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label class="admin-label">Council Card Cover Image</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" data-preview="councilPreview">
                                <input type="hidden" name="image" value="{{ $council->image ?? '' }}">
                                <div class="admin-img-preview-wrap mt-2">
                                    <img id="councilPreview" src="{{ $council->image_url }}" class="admin-img-preview" alt="Preview">
                                    <span class="text-muted small">Upload council cover image or photo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Committee Office Bearers Repeater -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-users"></i> Committee Office Bearers</h2>
                        <div class="admin-card-subtitle">Chairman, Vice Chairman, Secretary, and Additional Members</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addMemberBtn">
                        <i class="fa-solid fa-user-plus me-1"></i> Add Bearer
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="membersContainer" class="admin-repeater-list">
                        @php $members = old('members', $council->members ?? []); @endphp
                        @foreach ($members as $index => $m)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove member">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="admin-label">Role / Designation <span class="required">*</span></label>
                                        <input type="text" name="members[{{ $index }}][role]" class="admin-input" value="{{ $m['role'] ?? '' }}" required placeholder="e.g. Chairman">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Member Name <span class="required">*</span></label>
                                        <input type="text" name="members[{{ $index }}][name]" class="admin-input" value="{{ $m['name'] ?? '' }}" required placeholder="e.g. Haji Ghulam Murtaza">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="admin-label">Image Asset / File</label>
                                        <input type="text" name="members[{{ $index }}][image]" class="admin-input" value="{{ $m['image'] ?? 'images-6.jpg' }}" placeholder="images-6.jpg">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ $council->exists ? 'Update Union Council' : 'Save Union Council' }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let mIndex = {{ count($members) }};
    $('#addMemberBtn').on('click', function () {
        const tpl = `
            <div class="admin-repeater-item">
                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove member">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="admin-label">Role / Designation <span class="required">*</span></label>
                        <input type="text" name="members[${mIndex}][role]" class="admin-input" required placeholder="e.g. Additional Member">
                    </div>
                    <div class="col-md-5">
                        <label class="admin-label">Member Name <span class="required">*</span></label>
                        <input type="text" name="members[${mIndex}][name]" class="admin-input" required placeholder="Member full name">
                    </div>
                    <div class="col-md-3">
                        <label class="admin-label">Image Asset / File</label>
                        <input type="text" name="members[${mIndex}][image]" class="admin-input" value="images-6.jpg">
                    </div>
                </div>
            </div>
        `;
        $('#membersContainer').append(tpl);
        mIndex++;
    });
</script>
@endpush
