<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs
     */
    public function index()
    {
        $logs = ActivityLog::latest()
            ->paginate(50);

        $stats = [
            'total_logins' => ActivityLog::where('action', 'login')->where('status', 'success')->count(),
            'failed_logins' => ActivityLog::where('action', 'login')->where('status', 'failed')->count(),
            'total_actions' => ActivityLog::count(),
            'unique_users' => ActivityLog::distinct('admin_username')->count('admin_username'),
        ];

        return view('admin.activity-logs', compact('logs', 'stats'));
    }

    /**
     * Get activity logs for a specific user
     */
    public function user($username)
    {
        $logs = ActivityLog::where('admin_username', $username)
            ->latest()
            ->paginate(50);

        return view('admin.activity-logs', compact('logs'));
    }

    /**
     * Get failed login attempts
     */
    public function failedLogins()
    {
        $logs = ActivityLog::where('action', 'login')
            ->where('status', 'failed')
            ->latest()
            ->paginate(50);

        return view('admin.activity-logs', compact('logs'));
    }
}
