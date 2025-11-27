<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [FeedbackController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/api/categories', [FeedbackController::class, 'getCategories']);

// Admin authentication
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin dashboard (protected routes)
Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Feedback management
    Route::get('/admin/feedback', [AdminFeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/admin/feedback/{feedback}', [AdminFeedbackController::class, 'show'])->name('admin.feedback.show');
    Route::post('/admin/feedback/{feedback}/status', [AdminFeedbackController::class, 'updateStatus'])->name('admin.feedback.updateStatus');
    Route::post('/admin/feedback/{feedback}/response', [AdminFeedbackController::class, 'addResponse'])->name('admin.feedback.addResponse');
    Route::post('/admin/feedback/{feedback}/delete', [AdminFeedbackController::class, 'delete'])->name('admin.feedback.delete');

    // Category management
    Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::post('/admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::post('/admin/categories/{category}/delete', [AdminCategoryController::class, 'delete'])->name('admin.categories.delete');

    // Export functionality
    Route::get('/admin/export/csv', [\App\Http\Controllers\Admin\ExportController::class, 'csv'])->name('admin.export.csv');
    Route::get('/admin/export/pdf', [\App\Http\Controllers\Admin\ExportController::class, 'pdf'])->name('admin.export.pdf');

    // Activity logs
    Route::get('/admin/activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('admin.activity-logs');
    Route::get('/admin/activity-logs/user/{username}', [\App\Http\Controllers\Admin\ActivityLogController::class, 'user'])->name('admin.activity-logs.user');
    Route::get('/admin/activity-logs/failed', [\App\Http\Controllers\Admin\ActivityLogController::class, 'failedLogins'])->name('admin.activity-logs.failed');
});
