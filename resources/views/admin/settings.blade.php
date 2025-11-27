@extends('admin.layout')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">System Settings</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item">Dashboard</span>
        <span class="breadcrumb-item active">Settings</span>
    </div>
</div>

<!-- Settings Navigation -->
<div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
    <button class="btn btn-primary" onclick="showTab('general')"> General</button>
    <button class="btn btn-secondary" onclick="showTab('security')"> Security</button>
    <button class="btn class="btn btn-secondary" onclick="showTab('notifications')"> Notifications</button>
    <button class="btn btn-secondary" onclick="showTab('about')">About</button>
</div>

<!-- General Settings -->
<div id="general-tab" class="settings-tab">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Site Information</h3>
        </div>
        <form method="POST" action="/admin/settings/general">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="Feedback Box System" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Site Description</label>
                    <textarea name="site_description" class="form-control" rows="3">Platform feedback untuk Dinas Ketahanan Pangan</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" value="admin@feedbackbox.local" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" placeholder="+62-xxx-xxxx">
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success"> Save Changes</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Regional Settings</h3>
        </div>
        <form method="POST" action="/admin/settings/regional">
            @csrf
            <div class="card-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Timezone</label>
                        <select name="timezone" class="form-control">
                            <option selected>Asia/Jakarta</option>
                            <option>Asia/Bandung</option>
                            <option>Asia/Surabaya</option>
                            <option>UTC</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Language</label>
                        <select name="language" class="form-control">
                            <option selected>Indonesian (Bahasa Indonesia)</option>
                            <option>English</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label">Date Format</label>
                        <select name="date_format" class="form-control">
                            <option selected>d/m/Y</option>
                            <option>Y-m-d</option>
                            <option>m/d/Y</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Time Format</label>
                        <select name="time_format" class="form-control">
                            <option selected>H:i:s</option>
                            <option>h:i A</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success"> Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Security Settings -->
<div id="security-tab" class="settings-tab" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Login Security</h3>
        </div>
        <form method="POST" action="/admin/settings/security">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Max Login Attempts</label>
                    <input type="number" name="max_login_attempts" class="form-control" value="5" min="1" max="20">
                    <small style="color: #7f8c8d;">Number of attempts before lockout</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Lockout Duration (minutes)</label>
                    <input type="number" name="lockout_duration" class="form-control" value="15" min="1" max="120">
                    <small style="color: #7f8c8d;">How long to lock account after failed attempts</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Session Timeout (minutes)</label>
                    <input type="number" name="session_timeout" class="form-control" value="60" min="5" max="480">
                    <small style="color: #7f8c8d;">Automatically logout user after inactivity</small>
                </div>

                <div style="margin-top: 20px; padding: 15px; background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 6px;">
                    <div style="margin-bottom: 10px;">
                        <label class="form-label" style="display: flex; align-items: center; gap: 10px; margin: 0;">
                            <input type="checkbox" checked>
                            Require HTTPS
                        </label>
                    </div>
                    <div>
                        <label class="form-label" style="display: flex; align-items: center; gap: 10px; margin: 0;">
                            <input type="checkbox" checked>
                            Enable IP Whitelist
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success"> Save Changes</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Session Management</h3>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div>
                        <div style="font-weight: bold; color: #2c3e50;">Active Sessions</div>
                        <small style="color: #7f8c8d;">1 active session</small>
                    </div>
                    <button type="button" class="btn btn-danger" style="padding: 8px 16px;">
                        Logout All
                    </button>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>IP Address</th>
                        <th>Last Activity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Chrome on Windows</td>
                        <td>192.168.1.100</td>
                        <td>Just now</td>
                        <td><button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;">Logout</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Notification Settings -->
<div id="notifications-tab" class="settings-tab" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Notification Preferences</h3>
        </div>
        <div class="card-body">
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border: 1px solid #e0e6ed; border-radius: 6px;">
                    <div>
                        <div style="font-weight: bold; color: #2c3e50; margin-bottom: 3px;">New Feedback Received</div>
                        <small style="color: #7f8c8d;">Get notified when new feedback is submitted</small>
                    </div>
                    <label style="position: relative; display: inline-flex; cursor: pointer;">
                        <input type="checkbox" checked style="margin: 0;">
                    </label>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border: 1px solid #e0e6ed; border-radius: 6px;">
                    <div>
                        <div style="font-weight: bold; color: #2c3e50; margin-bottom: 3px;">Feedback Status Changed</div>
                        <small style="color: #7f8c8d;">Get notified when feedback status is updated</small>
                    </div>
                    <label style="position: relative; display: inline-flex; cursor: pointer;">
                        <input type="checkbox" checked style="margin: 0;">
                    </label>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border: 1px solid #e0e6ed; border-radius: 6px;">
                    <div>
                        <div style="font-weight: bold; color: #2c3e50; margin-bottom: 3px;">Failed Login Attempts</div>
                        <small style="color: #7f8c8d;">Get notified of suspicious login activity</small>
                    </div>
                    <label style="position: relative; display: inline-flex; cursor: pointer;">
                        <input type="checkbox" checked style="margin: 0;">
                    </label>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border: 1px solid #e0e6ed; border-radius: 6px;">
                    <div>
                        <div style="font-weight: bold; color: #2c3e50; margin-bottom: 3px;">System Alerts</div>
                        <small style="color: #7f8c8d;">Get notified of system issues and maintenance</small>
                    </div>
                    <label style="position: relative; display: inline-flex; cursor: pointer;">
                        <input type="checkbox" checked style="margin: 0;">
                    </label>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border: 1px solid #e0e6ed; border-radius: 6px;">
                    <div>
                        <div style="font-weight: bold; color: #2c3e50; margin-bottom: 3px;">Daily Report</div>
                        <small style="color: #7f8c8d;">Receive daily summary report via email</small>
                    </div>
                    <label style="position: relative; display: inline-flex; cursor: pointer;">
                        <input type="checkbox" style="margin: 0;">
                    </label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success"> Save Preferences</button>
        </div>
    </div>
</div>

<!-- About -->
<div id="about-tab" class="settings-tab" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> About This System</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 200px 1fr; gap: 20px;">
                <div style="font-weight: bold; color: #2c3e50;">System Name</div>
                <div>Feedback Box Management System</div>

                <div style="font-weight: bold; color: #2c3e50;">Version</div>
                <div>1.0.0</div>

                <div style="font-weight: bold; color: #2c3e50;">Build</div>
                <div>Build 20250126</div>

                <div style="font-weight: bold; color: #2c3e50;">Release Date</div>
                <div>26 November 2025</div>

                <div style="font-weight: bold; color: #2c3e50;">Developer</div>
                <div>Dinas Ketahanan Pangan</div>

                <div style="font-weight: bold; color: #2c3e50;">License</div>
                <div>Proprietary</div>

                <div style="font-weight: bold; color: #2c3e50;">Support</div>
                <div><a href="mailto:admin@feedbackbox.local" style="color: #3498db;">admin@feedbackbox.local</a></div>
            </div>

            <hr style="border: 1px solid #e0e6ed; margin: 20px 0;">

            <div style="background: #f9fafb; padding: 15px; border-radius: 6px;">
                <div style="font-weight: bold; margin-bottom: 10px;"> Installed Packages</div>
                <div style="font-size: 13px; color: #7f8c8d; line-height: 1.8;">
                    • Laravel 10.x (PHP Framework)<br>
                    • SQLite (Database)<br>
                    • Chart.js 3.9.1 (Charting)<br>
                    • Blade Templating Engine<br>
                    • CSRF Protection
                </div>
            </div>

            <div style="background: #f9fafb; padding: 15px; border-radius: 6px; margin-top: 15px;">
                <div style="font-weight: bold; margin-bottom: 10px;"> Documentation</div>
                <div style="font-size: 13px;">
                    <a href="/docs" style="color: #3498db; text-decoration: none;">View Documentation →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.style.display = 'none';
    });

    // Show selected tab
    document.getElementById(tabName + '-tab').style.display = 'block';

    // Update button styles
    document.querySelectorAll('button[onclick*="showTab"]').forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-secondary');
    });
    event.target.classList.remove('btn-secondary');
    event.target.classList.add('btn-primary');
}
</script>

@endsection
