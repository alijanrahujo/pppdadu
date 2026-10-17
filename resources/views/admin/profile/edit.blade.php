@extends('layouts.admin', [
    'title' => 'Admin Profile Settings',
    'pageTitle' => 'Account &bull; Admin Profile &amp; Password'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-user-gear"></i> Administrator Information</h2>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="name" class="admin-label">Admin Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" class="admin-input" value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="email" class="admin-label">Admin Email <span class="required">*</span></label>
                                <input type="email" id="email" name="email" class="admin-input" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Change -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="fa-solid fa-key"></i> Change Password (Optional)</h2>
                    <span class="text-muted small">Leave blank if you do not want to change password</span>
                </div>
                <div class="admin-card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="admin-form-group">
                                <label for="current_password" class="admin-label">Current Password</label>
                                <input type="password" id="current_password" name="current_password" class="admin-input" placeholder="Required only if changing password">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="password" class="admin-label">New Password</label>
                                <input type="password" id="password" name="password" class="admin-input" placeholder="Min. 8 characters">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label for="password_confirmation" class="admin-label">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="admin-input" placeholder="Re-enter new password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="admin-btn admin-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Update Profile &amp; Password</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
