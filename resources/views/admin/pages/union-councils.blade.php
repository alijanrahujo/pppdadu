@extends('layouts.admin', [
    'title' => 'Union Councils Page Header',
    'pageTitle' => 'Pages &bull; Union Councils Page Header'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.pages.union-councils.update') }}" method="POST">
            @csrf

            <div class="admin-card">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-sitemap"></i> Union Councils Introduction</h2>
                        <div class="admin-card-subtitle">Header text on the Union Council Bodies &amp; Members page</div>
                    </div>
                    <a href="{{ route('admin.councils.index') }}" class="btn btn-sm btn-outline-success">
                        <i class="fa-solid fa-layer-group me-1"></i> Manage Union Councils ({{ \App\Models\UnionCouncil::count() }})
                    </a>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Page Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['union_councils.title'] ?? 'Union Council Bodies & Members') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Kicker <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $settings['union_councils.eyebrow'] ?? 'Grassroots organization') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="subtitle" class="admin-label">Introduction / Subtitle <span class="required">*</span></label>
                                <textarea id="subtitle" name="subtitle" class="admin-textarea" rows="3" required>{{ old('subtitle', $settings['union_councils.subtitle'] ?? 'Our Union Councils are the strength of our organization at the grassroots level. Meet the dedicated office bearers and members working for the people of District Dadu.') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Header Text</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
