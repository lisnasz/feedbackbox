<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total statistics
        $totalFeedback = Feedback::count();
        $newFeedback = Feedback::where('status', 'baru')->count();
        $processingFeedback = Feedback::where('status', 'diproses')->count();
        $completedFeedback = Feedback::where('status', 'selesai')->count();

        // Feedback by status (for pie chart)
        $feedbackByStatus = Feedback::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Feedback by category (for bar chart)
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

        // Recent feedback (last 5)
        $recentFeedback = Feedback::with('category')
            ->latest()
            ->limit(5)
            ->get();

        // Response time statistics
        $avgResponseTime = Feedback::whereNotNull('admin_response')
            ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
            ->pluck('avg_days')
            ->first();

        $avgResponseTime = $avgResponseTime ? round($avgResponseTime, 1) : 0;

        // Status completion rate
        $completionRate = $totalFeedback > 0 
            ? round(($completedFeedback / $totalFeedback) * 100, 1)
            : 0;

        // Feedback trend (last 7 days)
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

        // Category statistics
        $categoryStats = Category::withCount('feedbacks')
            ->orderByDesc('feedbacks_count')
            ->get();

        // Pending feedback (not completed)
        $pendingCount = Feedback::whereIn('status', ['baru', 'diproses'])->count();

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
