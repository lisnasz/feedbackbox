@extends('admin.layout')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title">Activity Audit Trail</div>
    <div class="page-breadcrumb">
        <span class="breadcrumb-item">Dashboard</span>
        <span class="breadcrumb-item active">Activity Logs</span>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card primary">
        <div class="stat-label">Total Logins</div>
        <div class="stat-value">{{ $stats['total_logins'] ?? 0 }}</div>
        <div class="stat-change">Successful attempts</div>
    </div>

    <div class="stat-card danger">
        <div class="stat-label">Failed Logins</div>
        <div class="stat-value">{{ $stats['failed_logins'] ?? 0 }}</div>
        <div class="stat-change">Failed attempts</div>
    </div>

    <div class="stat-card warning">
        <div class="stat-label">Total Actions</div>
        <div class="stat-value">{{ $stats['total_actions'] ?? 0 }}</div>
        <div class="stat-change">Activities logged</div>
    </div>

    <div class="stat-card success">
        <div class="stat-label">Unique Users</div>
        <div class="stat-value">{{ $stats['unique_users'] ?? 0 }}</div>
        <div class="stat-change">Admin accounts</div>
    </div>
</div>

<!-- Filters -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> Filter Logs</h3>
    </div>
    <div class="card-body">
        <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px;">
            <div class="form-group">
                <label class="form-label">Admin User</label>
                <input type="text" name="user" class="form-control" placeholder="Username..." value="{{ request('user') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Action</label>
                <select name="action" class="form-control">
                    <option value="">All Actions</option>
                    <option value="login" {{ request('action') == 'login' ? 'selected' : '' }}>Login</option>
                    <option value="logout" {{ request('action') == 'logout' ? 'selected' : '' }}>Logout</option>
                    <option value="feedback_viewed" {{ request('action') == 'feedback_viewed' ? 'selected' : '' }}>Feedback Viewed</option>
                    <option value="feedback_updated" {{ request('action') == 'feedback_updated' ? 'selected' : '' }}>Feedback Updated</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                     Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Activity Logs Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Activity Log ({{ $activities->count() ?? 0 }})</h3>
    </div>
    <div class="card-body">
        @if($activities && $activities->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Admin</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>
                                <span style="font-size: 12px;">
                                    {{ $activity->created_at->format('d/m/Y H:i:s') }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $activity->admin_username }}</strong>
                            </td>
                            <td>
                                <code style="background: #f5f7fa; padding: 4px 8px; border-radius: 3px;">
                                    {{ $activity->action }}
                                </code>
                            </td>
                            <td>
                                {{ Str::limit($activity->description, 50) }}
                                <br>
                                <small style="color: #7f8c8d; font-size: 11px;">
                                    UA: {{ Str::limit($activity->user_agent, 50) }}
                                </small>
                            </td>
                            <td>
                                <code style="font-family: monospace; font-size: 12px;">
                                    {{ $activity->ip_address }}
                                </code>
                            </td>
                            <td>
                                @if($activity->status == 'success')
                                    <span class="badge badge-success">Success</span>
                                @elseif($activity->status == 'failed')
                                    <span class="badge badge-danger"> Failed</span>
                                @else
                                    <span class="badge badge-warning"> Error</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if($activities instanceof \Illuminate\Pagination\Paginator)
                <div style="margin-top: 20px;">
                    {{ $activities->links() }}
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 40px; color: #7f8c8d;">
                <p>No activities found</p>
            </div>
        @endif
    </div>
</div>

<!-- Failed Logins Alert -->
@if(($stats['failed_logins'] ?? 0) > 5)
    <div class="alert alert-danger">
        <strong>Security Alert:</strong> {{ $stats['failed_logins'] }} failed login attempts detected. Please review activity logs.
    </div>
@endif

@endsection
