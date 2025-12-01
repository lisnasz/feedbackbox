<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Debug: Log dashboard access
        $debugMode = config('app.debug');
        if ($debugMode) {
            Log::info('Dashboard accessed', [
                'timestamp' => now(),
                'user_id' => auth()->id(),
                'ip_address' => request()->ip()
            ]);
        }
        // Total statistics
        $totalFeedback = Feedback::count();
        $newFeedback = Feedback::where('status', 'baru')->count();
        $processingFeedback = Feedback::where('status', 'diproses')->count();
        $completedFeedback = Feedback::where('status', 'selesai')->count();

        // Debug: Log statistics
        if ($debugMode) {
            Log::debug('Dashboard Statistics', [
                'total_feedback' => $totalFeedback,
                'new_feedback' => $newFeedback,
                'processing_feedback' => $processingFeedback,
                'completed_feedback' => $completedFeedback
            ]);
        }

        // Feedback by status (for pie chart)
        try {
            $feedbackByStatus = Feedback::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            if ($debugMode) {
                Log::debug('Feedback by Status', [
                    'data' => $feedbackByStatus,
                    'total_statuses' => count($feedbackByStatus)
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching feedback by status', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $feedbackByStatus = [];
        }

        // Feedback by category (for bar chart)
        try {
            $feedbackByCategory = Feedback::select('category_id', DB::raw('count(*) as count'))
                ->with('category')
                ->groupBy('category_id')
                ->get()
                ->map(function($item) {
                    return [
                        'category' => $item->category ? $item->category->name : 'Uncategorized',
                        'count' => $item->count
                    ];
                });

            if ($debugMode) {
                Log::debug('Feedback by Category', [
                    'categories' => $feedbackByCategory->toArray(),
                    'total_categories' => $feedbackByCategory->count()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching feedback by category', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $feedbackByCategory = [];
        }

        // Recent feedback (last 5)
        try {
            $recentFeedback = Feedback::with('category')
                ->latest()
                ->limit(5)
                ->get();

            if ($debugMode) {
                Log::debug('Recent Feedback', [
                    'count' => $recentFeedback->count(),
                    'ids' => $recentFeedback->pluck('id')->toArray()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching recent feedback', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $recentFeedback = [];
        }

        // Response time statistics
        try {
            $avgResponseTime = Feedback::whereNotNull('admin_response')
                ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
                ->pluck('avg_days')
                ->first();

            $avgResponseTime = $avgResponseTime ? round($avgResponseTime, 1) : 0;

            if ($debugMode) {
                Log::debug('Response Time Statistics', [
                    'avg_response_days' => $avgResponseTime,
                    'responded_count' => Feedback::whereNotNull('admin_response')->count()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error calculating response time', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $avgResponseTime = 0;
        }

        // Status completion rate
        $completionRate = $totalFeedback > 0 
            ? round(($completedFeedback / $totalFeedback) * 100, 1)
            : 0;

        if ($debugMode) {
            Log::debug('Completion Rate', [
                'completion_rate' => $completionRate . '%',
                'completed' => $completedFeedback,
                'total' => $totalFeedback
            ]);
        }

        // Feedback trend (last 7 days)
        try {
            $feedbackTrend = Feedback::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->whereDate('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->map(function($item) {
                    return [
                        'date' => $item->date,
                        'count' => $item->count
                    ];
                });

            if ($debugMode) {
                Log::debug('Feedback Trend (7 days)', [
                    'trend_data' => $feedbackTrend->toArray(),
                    'total_days_with_feedback' => $feedbackTrend->count()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching feedback trend', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $feedbackTrend = [];
        }

        // Category statistics
        try {
            $categoryStats = Category::withCount('feedbacks')
                ->orderByDesc('feedbacks_count')
                ->get();

            if ($debugMode) {
                Log::debug('Category Statistics', [
                    'total_categories' => $categoryStats->count(),
                    'categories' => $categoryStats->map(fn($cat) => [
                        'name' => $cat->name,
                        'count' => $cat->feedbacks_count
                    ])->toArray()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching category statistics', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $categoryStats = [];
        }

        // Pending feedback (not completed)
        try {
            $pendingCount = Feedback::whereIn('status', ['baru', 'diproses'])->count();

            if ($debugMode) {
                Log::debug('Pending Feedback', [
                    'pending_count' => $pendingCount,
                    'baru' => Feedback::where('status', 'baru')->count(),
                    'diproses' => Feedback::where('status', 'diproses')->count()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching pending feedback', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            $pendingCount = 0;
        }

        return view('admin.dashboard', compact(
            'totalFeedback',
            'newFeedback',
            'processingFeedback',
            'completedFeedback',
            'feedbackByStatus',
            'feedbackByCategory',
            'recentFeedback',
            'avgResponseTime',
            'completionRate',
            'feedbackTrend',
            'categoryStats',
            'pendingCount'
        ));
    }
}
