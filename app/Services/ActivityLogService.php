<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogService
{
    /**
     * Log activity to database
     */
    public static function log(
        string $username,
        string $action,
        ?string $description = null,
        ?string $status = 'success',
        ?Request $request = null
    ): void {
        try {
            ActivityLog::create([
                'admin_username' => $username,
                'action' => $action,
                'description' => $description,
                'ip_address' => $request ? $request->ip() : request()->ip(),
                'user_agent' => $request ? $request->userAgent() : request()->userAgent(),
                'status' => $status,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to log activity: ' . $e->getMessage());
        }
    }

    /**
     * Get activity logs with filters
     */
    public static function getActivities(
        ?string $username = null,
        ?string $action = null,
        ?int $limit = 50
    ) {
        $query = ActivityLog::query();

        if ($username) {
            $query->where('admin_username', $username);
        }

        if ($action) {
            $query->where('action', $action);
        }

        return $query->latest()->limit($limit)->get();
    }

    /**
     * Get login attempts count in last X minutes
     */
    public static function getLoginAttempts(string $ip, int $minutes = 15): int
    {
        return ActivityLog::where('ip_address', $ip)
            ->where('action', 'login')
            ->where('status', 'failed')
            ->where('created_at', '>=', now()->subMinutes($minutes))
            ->count();
    }
}
