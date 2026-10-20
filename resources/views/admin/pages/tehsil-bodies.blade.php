@extends('layouts.admin', [
    'title' => 'Tehsil Bodies Content',
    'pageTitle' => 'Pages • Tehsil Bodies (Taluka Committees) Content'
])

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-editor.note-frame {
        border: 1px solid var(--admin-border);
        border-radius: 6px;
        background: #ffffff;
    }
    .note-editor.note-frame .note-toolbar {
        background: #f8faf9;
        border-bottom: 1px solid var(--admin-border);
        border-radius: 6px 6px 0 0;
        padding: 6px 8px;
    }
    .note-editor.note-frame .note-statusbar {
        background: #f8faf9;
        border-top: 1px solid var(--admin-border);
    }
    .note-editor.note-frame .note-editing-area .note-editable {
        min-height: 180px;
        font-size: 14px;
        line-height: 1.6;
        color: var(--admin-text-main);
    }
    .note-btn {
        background: #ffffff;
        border: 1px solid #d5e2d8;
        color: var(--admin-text-main);
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .note-btn:hover {
        background: #f0f4f1;
    }
    .note-btn.active {
        background: var(--admin-green);
        color: #ffffff;
        border-color: var(--admin-green);
    }
    .tehsil-admin-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 18px 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }
    .tehsil-admin-box-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 12px;
        margin-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .tehsil-member-row {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <form action="{{ route('admin.pages.tehsil-bodies.update') }}" method="POST">
            @csrf

            <!-- Header & Overview Text -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-landmark"></i> Page Headings &amp; Overview</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="title" class="admin-label">Page Title <span class="required">*</span></label>
                                <input type="text" id="title" name="title" class="admin-input" value="{{ old('title', $settings['tehsil_bodies.title'] ?? 'Tehsil Bodies') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="eyebrow" class="admin-label">Eyebrow Kicker <span class="required">*</span></label>
                                <input type="text" id="eyebrow" name="eyebrow" class="admin-input" value="{{ old('eyebrow', $settings['tehsil_bodies.eyebrow'] ?? 'Grassroots Organization') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="subtitle" class="admin-label">Subtitle Heading <span class="required">*</span></label>
                                <input type="text" id="subtitle" name="subtitle" class="admin-input" value="{{ old('subtitle', $settings['tehsil_bodies.subtitle'] ?? 'Working for the People across All 4 Tehsils of District Dadu') }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="description" class="admin-label">Description (Rich Text Editor) <span class="required">*</span></label>
                                <textarea id="description" name="description" class="admin-textarea" rows="4" required>{{ old('description', $settings['tehsil_bodies.description'] ?? '<p>Pakistan Peoples Party has a robust grassroots organizational network spread across all four tehsils of District Dadu: <strong>Dadu</strong>, <strong>Mehar</strong>, <strong>Khairpur Nathan Shah</strong>, and <strong>Johi</strong>.</p><p>Our dedicated Tehsil office bearers work relentlessly to mobilize party workers, address local community issues, and implement the progressive vision of our leadership at the town and village level.</p>') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-chart-pie"></i> Local Statistics Bar</h2>
                        <div class="admin-card-subtitle">Tehsils, Union Councils, Bearers, and Active Workers</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addStatBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Statistic
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="statsContainer" class="admin-repeater-list">
                        @php
                            $statistics = $settings['tehsil_bodies.statistics'] ?? [
                                ['value' => '4', 'label' => 'Tehsils / Talukas', 'icon' => 'fa-landmark', 'color' => 'red'],
                                ['value' => '52+', 'label' => 'Union Councils', 'icon' => 'fa-people-roof', 'color' => 'green'],
                                ['value' => '100+', 'label' => 'Office Bearers', 'icon' => 'fa-user-group', 'color' => 'red'],
                                ['value' => '250+', 'label' => 'Ward & Village Units', 'icon' => 'fa-location-dot', 'color' => 'green'],
                                ['value' => '50k+', 'label' => 'Active Workers & Supporters', 'icon' => 'fa-users', 'color' => 'red'],
                            ];
                        @endphp
                        @foreach ($statistics as $index => $stat)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="admin-label">Number / Count <span class="required">*</span></label>
                                        <input type="text" name="statistics[{{ $index }}][value]" class="admin-input" value="{{ $stat['value'] ?? '' }}" required placeholder="e.g. 4">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="admin-label">Label <span class="required">*</span></label>
                                        <input type="text" name="statistics[{{ $index }}][label]" class="admin-input" value="{{ $stat['label'] ?? '' }}" required placeholder="e.g. Tehsils">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="admin-label">FontAwesome Icon</label>
                                        <input type="text" name="statistics[{{ $index }}][icon]" class="admin-input" value="{{ $stat['icon'] ?? 'fa-landmark' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon Color</label>
                                        <select name="statistics[{{ $index }}][color]" class="admin-select">
                                            <option value="red" {{ ($stat['color'] ?? '') === 'red' ? 'selected' : '' }}>Red</option>
                                            <option value="green" {{ ($stat['color'] ?? '') === 'green' ? 'selected' : '' }}>Green</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tehsil Bodies & Office Bearers -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-sitemap"></i> Tehsil Bodies &amp; Office Bearers</h2>
                        <div class="admin-card-subtitle">Manage each Tehsil organization and its office bearers</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addTehsilBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Another Tehsil
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="tehsilsContainer">
                        @php
                            $defaultTehsils = [
                                [
                                    'name' => 'Tehsil Dadu',
                                    'urdu_name' => 'تحصیل دادو',
                                    'tagline' => 'District Headquarters & Central Hub',
                                    'description' => 'Covering Dadu city and surrounding rural union councils with active party leadership dedicated to public welfare and infrastructure.',
                                    'members' => [
                                        ['role' => 'President', 'name' => 'Syed Zafar Ali Shah', 'phone' => '025-4551234'],
                                        ['role' => 'General Secretary', 'name' => 'Muhammad Aslam Panhwar', 'phone' => ''],
                                        ['role' => 'Senior Vice President', 'name' => 'Haji Ghulam Rasool Solangi', 'phone' => ''],
                                        ['role' => 'Information Secretary', 'name' => 'Liaquat Ali Jamali', 'phone' => ''],
                                        ['role' => 'Finance Secretary', 'name' => 'Tariq Hussain Memon', 'phone' => ''],
                                    ],
                                ],
                                [
                                    'name' => 'Tehsil Mehar',
                                    'urdu_name' => 'تحصیل میہڑ',
                                    'tagline' => 'Agricultural Heart & Vibrant Grassroots Network',
                                    'description' => 'Mobilizing agricultural workers, youth activists and rural families across the fertile taluka of Mehar.',
                                    'members' => [
                                        ['role' => 'President', 'name' => 'Sardar Ghulam Mustafa Mahisar', 'phone' => ''],
                                        ['role' => 'General Secretary', 'name' => 'Aijaz Ahmed Chandio', 'phone' => ''],
                                        ['role' => 'Senior Vice President', 'name' => 'Ali Nawaz Siyal', 'phone' => ''],
                                        ['role' => 'Information Secretary', 'name' => 'Kareem Bux Soomro', 'phone' => ''],
                                        ['role' => 'Finance Secretary', 'name' => 'Muhammad Ramzan Khoso', 'phone' => ''],
                                    ],
                                ],
                                [
                                    'name' => 'Tehsil Khairpur Nathan Shah',
                                    'urdu_name' => 'تحصیل خیرپور ناتھن شاہ',
                                    'tagline' => 'Resilient Leadership & People-First Public Service',
                                    'description' => 'Leading community rehabilitation, public health, clean water initiatives, and local party organizing throughout K.N. Shah.',
                                    'members' => [
                                        ['role' => 'President', 'name' => 'Mir Ghulam Shabbir Lund', 'phone' => ''],
                                        ['role' => 'General Secretary', 'name' => 'Nadeem Ahmed Kalhoro', 'phone' => ''],
                                        ['role' => 'Senior Vice President', 'name' => 'Ghulam Abbas Leghari', 'phone' => ''],
                                        ['role' => 'Information Secretary', 'name' => 'Barkat Ali Bughio', 'phone' => ''],
                                        ['role' => 'Finance Secretary', 'name' => 'Manzoor Hussain Chandio', 'phone' => ''],
                                    ],
                                ],
                                [
                                    'name' => 'Tehsil Johi',
                                    'urdu_name' => 'تحصیل جوہی',
                                    'tagline' => 'Kachho Foothills & Dedicated Community Organizing',
                                    'description' => 'Dedicated to empowering the rural and Kachho communities, ensuring water rights, and uplifting rural families across Johi.',
                                    'members' => [
                                        ['role' => 'President', 'name' => 'Mir Ahmed Khan Babar', 'phone' => ''],
                                        ['role' => 'General Secretary', 'name' => 'Syed Mazhar Ali Shah', 'phone' => ''],
                                        ['role' => 'Senior Vice President', 'name' => 'Sikandar Ali Rodnani', 'phone' => ''],
                                        ['role' => 'Information Secretary', 'name' => 'Ali Murad Rind', 'phone' => ''],
                                        ['role' => 'Finance Secretary', 'name' => 'Akhtar Hussain Jamali', 'phone' => ''],
                                    ],
                                ],
                            ];
                            $tehsils = $settings['tehsil_bodies.tehsils'] ?? $defaultTehsils;
                        @endphp

                        @foreach ($tehsils as $tIndex => $tehsil)
                            <div class="tehsil-admin-box" data-tehsil-index="{{ $tIndex }}">
                                <div class="tehsil-admin-box-header">
                                    <h4 class="m-0 fw-bold text-success"><i class="fa-solid fa-building me-1"></i> Tehsil #{{ $tIndex + 1 }}: <span class="tehsil-name-display">{{ $tehsil['name'] ?? 'Tehsil' }}</span></h4>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="$(this).closest('.tehsil-admin-box').remove()">
                                        <i class="fa-solid fa-trash me-1"></i> Remove Tehsil
                                    </button>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="admin-label">Tehsil Name <span class="required">*</span></label>
                                        <input type="text" name="tehsils[{{ $tIndex }}][name]" class="admin-input tehsil-name-input" value="{{ $tehsil['name'] ?? '' }}" required placeholder="e.g. Tehsil Dadu">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="admin-label">Urdu / Sindhi Name</label>
                                        <input type="text" name="tehsils[{{ $tIndex }}][urdu_name]" class="admin-input text-end" value="{{ $tehsil['urdu_name'] ?? '' }}" placeholder="تحصیل دادو">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Tagline / Location Note</label>
                                        <input type="text" name="tehsils[{{ $tIndex }}][tagline]" class="admin-input" value="{{ $tehsil['tagline'] ?? '' }}" placeholder="e.g. District Headquarters">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="admin-label">Tehsil Photo / Landmark Image (Optional)</label>
                                        <input type="text" name="tehsils[{{ $tIndex }}][image]" class="admin-input" value="{{ $tehsil['image'] ?? '' }}" placeholder="e.g. Assets/images/images-3.jpg">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="admin-label">Overview Description</label>
                                        <textarea name="tehsils[{{ $tIndex }}][description]" class="admin-textarea" rows="2" placeholder="Brief overview of the Tehsil organization...">{{ $tehsil['description'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <!-- Members Sub-repeater -->
                                <div class="p-3 bg-light rounded border">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-dark small text-uppercase"><i class="fa-solid fa-users me-1"></i> Office Bearers for this Tehsil</strong>
                                        <button type="button" class="btn btn-xs btn-outline-success add-member-btn" data-tehsil-index="{{ $tIndex }}">
                                            <i class="fa-solid fa-user-plus me-1"></i> Add Bearer
                                        </button>
                                    </div>
                                    <div class="tehsil-members-list" id="tehsilMembers_{{ $tIndex }}">
                                        @foreach ($tehsil['members'] ?? [] as $mIndex => $member)
                                            <div class="tehsil-member-row">
                                                <div class="flex-grow-1">
                                                    <div class="row g-2">
                                                        <div class="col-md-3">
                                                            <input type="text" name="tehsils[{{ $tIndex }}][members][{{ $mIndex }}][role]" class="admin-input form-control-sm" value="{{ $member['role'] ?? '' }}" required placeholder="Role (e.g. President)">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" name="tehsils[{{ $tIndex }}][members][{{ $mIndex }}][name]" class="admin-input form-control-sm" value="{{ $member['name'] ?? '' }}" required placeholder="Leader Name">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" name="tehsils[{{ $tIndex }}][members][{{ $mIndex }}][phone]" class="admin-input form-control-sm" value="{{ $member['phone'] ?? '' }}" placeholder="Phone (Optional)">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" name="tehsils[{{ $tIndex }}][members][{{ $mIndex }}][image]" class="admin-input form-control-sm" value="{{ $member['image'] ?? '' }}" placeholder="Photo URL/Path (Optional)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-danger p-1 px-2" onclick="$(this).closest('.tehsil-member-row').remove()" title="Remove Bearer">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Key Priorities -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="admin-card-title"><i class="fa-solid fa-bullseye"></i> Key Responsibilities &amp; Priorities</h2>
                        <div class="admin-card-subtitle">Areas of focus for Tehsil party committees</div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addPriorityBtn">
                        <i class="fa-solid fa-plus me-1"></i> Add Priority
                    </button>
                </div>
                <div class="admin-card-body">
                    <div id="prioritiesContainer" class="admin-repeater-list">
                        @php
                            $priorities = $settings['tehsil_bodies.priorities'] ?? [
                                ['title' => 'Grassroots Mobilization', 'description' => 'Maintaining direct contact with workers and families across every village and ward.', 'icon' => 'fa-people-group'],
                                ['title' => 'Public Grievance Redressal', 'description' => 'Acting as the bridge between citizens and public administration to solve local problems.', 'icon' => 'fa-bullhorn'],
                                ['title' => 'Community Development', 'description' => 'Overseeing drinking water, rural education, health facilities and public infrastructure.', 'icon' => 'fa-chart-line'],
                                ['title' => 'Social Justice & Democracy', 'description' => 'Upholding Quaid-e-Awam and Shaheed Mohtarma Benazir Bhutto’s vision for equal rights and progress.', 'icon' => 'fa-scale-balanced'],
                            ];
                        @endphp
                        @foreach ($priorities as $index => $item)
                            <div class="admin-repeater-item">
                                <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <label class="admin-label">Priority Title <span class="required">*</span></label>
                                        <input type="text" name="priorities[{{ $index }}][title]" class="admin-input" value="{{ $item['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="admin-label">Description <span class="required">*</span></label>
                                        <input type="text" name="priorities[{{ $index }}][description]" class="admin-input" value="{{ $item['description'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="admin-label">Icon</label>
                                        <input type="text" name="priorities[{{ $index }}][icon]" class="admin-input" value="{{ $item['icon'] ?? 'fa-circle-check' }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save Tehsil Bodies Content</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script>
    jQuery(function ($) {
        // Initialize Summernote Rich Text Editor for description
        $('#description').summernote({
            placeholder: 'Write comprehensive description of Tehsil bodies...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Ensure Summernote code is copied into textarea on form submit, even from codeview mode
        $('form').on('submit', function () {
            $('#description').each(function () {
                const $el = $(this);
                if ($el.summernote('codeview.isActivated')) {
                    $el.summernote('codeview.deactivate');
                }
                $el.val($el.summernote('code'));
            });
        });

        // Add Statistic repeater
        let sIndex = {{ count($statistics) }};
        $('#addStatBtn').on('click', function () {
            const tpl = `
                <div class="admin-repeater-item">
                    <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="admin-label">Number / Count <span class="required">*</span></label>
                            <input type="text" name="statistics[${sIndex}][value]" class="admin-input" required placeholder="50+">
                        </div>
                        <div class="col-md-4">
                            <label class="admin-label">Label <span class="required">*</span></label>
                            <input type="text" name="statistics[${sIndex}][label]" class="admin-input" required placeholder="Label">
                        </div>
                        <div class="col-md-3">
                            <label class="admin-label">FontAwesome Icon</label>
                            <input type="text" name="statistics[${sIndex}][icon]" class="admin-input" value="fa-landmark" required>
                        </div>
                        <div class="col-md-2">
                            <label class="admin-label">Icon Color</label>
                            <select name="statistics[${sIndex}][color]" class="admin-select">
                                <option value="red">Red</option>
                                <option value="green" selected>Green</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            $('#statsContainer').append(tpl);
            sIndex++;
        });

        // Add Priority repeater
        let prIndex = {{ count($priorities) }};
        $('#addPriorityBtn').on('click', function () {
            const tpl = `
                <div class="admin-repeater-item">
                    <button type="button" class="admin-repeater-remove" onclick="$(this).closest('.admin-repeater-item').remove()" title="Remove this item">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="admin-label">Priority Title <span class="required">*</span></label>
                            <input type="text" name="priorities[${prIndex}][title]" class="admin-input" required placeholder="Title">
                        </div>
                        <div class="col-md-5">
                            <label class="admin-label">Description <span class="required">*</span></label>
                            <input type="text" name="priorities[${prIndex}][description]" class="admin-input" required placeholder="Description">
                        </div>
                        <div class="col-md-2">
                            <label class="admin-label">Icon</label>
                            <input type="text" name="priorities[${prIndex}][icon]" class="admin-input" value="fa-circle-check" required>
                        </div>
                    </div>
                </div>
            `;
            $('#prioritiesContainer').append(tpl);
            prIndex++;
        });

        // Update Tehsil title display as user types
        $(document).on('input', '.tehsil-name-input', function () {
            const val = $(this).val().trim();
            $(this).closest('.tehsil-admin-box').find('.tehsil-name-display').text(val || 'Tehsil');
        });

        // Add Bearer row to a specific Tehsil
        $(document).on('click', '.add-member-btn', function () {
            const tIndex = $(this).data('tehsil-index');
            const $list = $('#tehsilMembers_' + tIndex);
            const mIndex = $list.find('.tehsil-member-row').length + Date.now();
            const rowTpl = `
                <div class="tehsil-member-row">
                    <div class="flex-grow-1">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <input type="text" name="tehsils[${tIndex}][members][${mIndex}][role]" class="admin-input form-control-sm" required placeholder="Role (e.g. Vice President)">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="tehsils[${tIndex}][members][${mIndex}][name]" class="admin-input form-control-sm" required placeholder="Leader Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="tehsils[${tIndex}][members][${mIndex}][phone]" class="admin-input form-control-sm" placeholder="Phone (Optional)">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="tehsils[${tIndex}][members][${mIndex}][image]" class="admin-input form-control-sm" placeholder="Photo URL/Path (Optional)">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger p-1 px-2" onclick="$(this).closest('.tehsil-member-row').remove()" title="Remove Bearer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            `;
            $list.append(rowTpl);
        });

        // Add Entire New Tehsil box
        let nextTehsilIndex = {{ count($tehsils) }};
        $('#addTehsilBtn').on('click', function () {
            const tIndex = nextTehsilIndex++;
            const tehsilTpl = `
                <div class="tehsil-admin-box" data-tehsil-index="${tIndex}">
                    <div class="tehsil-admin-box-header">
                        <h4 class="m-0 fw-bold text-success"><i class="fa-solid fa-building me-1"></i> Tehsil #${tIndex + 1}: <span class="tehsil-name-display">New Tehsil</span></h4>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="$(this).closest('.tehsil-admin-box').remove()">
                            <i class="fa-solid fa-trash me-1"></i> Remove Tehsil
                        </button>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="admin-label">Tehsil Name <span class="required">*</span></label>
                            <input type="text" name="tehsils[${tIndex}][name]" class="admin-input tehsil-name-input" required placeholder="e.g. Tehsil Name">
                        </div>
                        <div class="col-md-3">
                            <label class="admin-label">Urdu / Sindhi Name</label>
                            <input type="text" name="tehsils[${tIndex}][urdu_name]" class="admin-input text-end" placeholder="تحصیل">
                        </div>
                        <div class="col-md-5">
                            <label class="admin-label">Tagline / Location Note</label>
                            <input type="text" name="tehsils[${tIndex}][tagline]" class="admin-input" placeholder="e.g. Sub-division">
                        </div>
                        <div class="col-md-6">
                            <label class="admin-label">Tehsil Photo / Landmark Image (Optional)</label>
                            <input type="text" name="tehsils[${tIndex}][image]" class="admin-input" placeholder="e.g. Assets/images/images-3.jpg">
                        </div>
                        <div class="col-md-6">
                            <label class="admin-label">Overview Description</label>
                            <textarea name="tehsils[${tIndex}][description]" class="admin-textarea" rows="2" placeholder="Brief overview of the Tehsil organization..."></textarea>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded border">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-dark small text-uppercase"><i class="fa-solid fa-users me-1"></i> Office Bearers for this Tehsil</strong>
                            <button type="button" class="btn btn-xs btn-outline-success add-member-btn" data-tehsil-index="${tIndex}">
                                <i class="fa-solid fa-user-plus me-1"></i> Add Bearer
                            </button>
                        </div>
                        <div class="tehsil-members-list" id="tehsilMembers_${tIndex}">
                            <div class="tehsil-member-row">
                                <div class="flex-grow-1">
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <input type="text" name="tehsils[${tIndex}][members][0][role]" class="admin-input form-control-sm" value="President" required placeholder="Role">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="tehsils[${tIndex}][members][0][name]" class="admin-input form-control-sm" required placeholder="Leader Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="tehsils[${tIndex}][members][0][phone]" class="admin-input form-control-sm" placeholder="Phone (Optional)">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="tehsils[${tIndex}][members][0][image]" class="admin-input form-control-sm" placeholder="Photo URL/Path (Optional)">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger p-1 px-2" onclick="$(this).closest('.tehsil-member-row').remove()" title="Remove Bearer">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#tehsilsContainer').append(tehsilTpl);
        });
    });
</script>
@endpush
