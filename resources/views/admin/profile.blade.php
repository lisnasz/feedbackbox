@extends('admin.layout')

@section('title', 'Admin Profile')
@section('page-title', 'Admin Profile')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">Admin Profile</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item">Dashboard</span>
        <span class="breadcrumb-item active">Profile</span>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 350px; gap: 20px;">
    <!-- Main Content -->
    <div>
        <!-- Profile Information -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Profile Information</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                    <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; flex-shrink: 0;">
                        A
                    </div>
                    <div>
                        <div style="font-size: 24px; font-weight: bold; color: #2c3e50; margin-bottom: 5px;">
                            Administrator
                        </div>
                        <div style="color: #7f8c8d; font-size: 14px; margin-bottom: 10px;">
                            Admin User
                        </div>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>

                <hr style="border: 1px solid #e0e6ed; margin: 20px 0;">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <div class="form-label">Username</div>
                        <div style="padding: 10px; background: #f9fafb; border-radius: 6px; border: 1px solid #e0e6ed;">
                            admin
                        </div>
                    </div>
                    <div>
                        <div class="form-label">Role</div>
                        <div style="padding: 10px; background: #f9fafb; border-radius: 6px; border: 1px solid #e0e6ed;">
                            Administrator
                        </div>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <div class="form-label">Email</div>
                    <div style="padding: 10px; background: #f9fafb; border-radius: 6px; border: 1px solid #e0e6ed;">
                        admin@feedbackbox.local
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <div class="form-label">Last Login</div>
                    <div style="padding: 10px; background: #f9fafb; border-radius: 6px; border: 1px solid #e0e6ed;">
                        Today at 14:30:00
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Change Password</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/profile/change-password">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                        @error('current_password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                        @error('new_password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                        <small style="color: #7f8c8d; margin-top: 5px; display: block;">
                            • At least 8 characters long<br>
                            • Mix of uppercase and lowercase<br>
                            • Include numbers and special characters
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm new password" required>
                        @error('new_password_confirmation')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary"> Update Password</button>
                </form>
            </div>
        </div>

        <!-- Two-Factor Authentication -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Two-Factor Authentication</h3>
            </div>
            <div class="card-body">
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <div style="font-weight: bold; color: #2c3e50; margin-bottom: 5px;">2FA Status</div>
                            <div style="color: #7f8c8d; font-size: 13px;">Enhance account security with two-factor authentication</div>
                        </div>
                        <span class="badge badge-danger">Disabled</span>
                    </div>
                </div>
                <button class="btn btn-primary"> Enable 2FA</button>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Activity Summary -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Activity</h3>
            </div>
            <div class="card-body" style="font-size: 13px;">
                <div style="margin-bottom: 15px;">
                    <div class="form-label" style="font-size: 11px;">Login Count</div>
                    <div style="font-size: 20px; font-weight: bold; color: #3498db;">42</div>
                </div>
                <div style="margin-bottom: 15px;">
                    <div class="form-label" style="font-size: 11px;">Actions Today</div>
                    <div style="font-size: 20px; font-weight: bold; color: #2ecc71;">15</div>
                </div>
                <div>
                    <div class="form-label" style="font-size: 11px;">Last Action</div>
                    <div style="color: #7f8c8d;">2 minutes ago</div>
                </div>
            </div>
        </div>

        <!-- Security Status -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Security</h3>
            </div>
            <div class="card-body" style="font-size: 13px;">
                <div style="margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                        <span>Password Strength</span>
                        <strong style="color: #2ecc71;">Strong</strong>
                    </div>
                    <div style="width: 100%; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                        <div style="width: 85%; height: 100%; background: #2ecc71;"></div>
                    </div>
                </div>

                <div style="margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                        <span>2FA Protection</span>
                        <strong style="color: #e74c3c;">Not Enabled</strong>
                    </div>
                    <div style="width: 100%; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                        <div style="width: 0%; height: 100%; background: #e74c3c;"></div>
                    </div>
                </div>

                <div style="padding: 10px; background: #fff3cd; border: 1px solid #ffc107; border-radius: 6px; color: #856404; font-size: 12px; margin-top: 15px;">
                     Enable 2FA to improve security
                </div>
            </div>
        </div>

        <!-- Sessions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Active Sessions</h3>
            </div>
            <div class="card-body" style="font-size: 13px;">
                <div style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <div style="font-weight: bold; margin-bottom: 2px;">Current Device</div>
                            <div style="color: #7f8c8d; font-size: 12px;">Windows • Chrome</div>
                            <div style="color: #7f8c8d; font-size: 11px; margin-top: 3px;">192.168.1.100</div>
                        </div>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>
                <hr style="border: 1px solid #e0e6ed; margin: 10px 0;">
                <button class="btn btn-danger" style="width: 100%; padding: 8px;">
                    Logout All Devices
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
