# 🔄 ROUTES UPDATE GUIDE

**For**: Switching from old admin pages to new separated pages  
**Status**: Implementation Guide  
**Date**: 27 November 2025

---

## 📋 CURRENT ROUTES (Old)

```php
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', fn() => view('admin.dashboard'));
    Route::get('/admin/feedback', [FeedbackController::class, 'index']);
    Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show']);
    Route::post('/admin/feedback/{id}', [FeedbackController::class, 'update']);
    Route::delete('/admin/feedback/{id}', [FeedbackController::class, 'destroy']);
    
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/categories/store', [CategoryController::class, 'store']);
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);
    
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index']);
    Route::get('/admin/logout', [AuthController::class, 'logout']);
});

Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);
```

---

## 📋 NEW ROUTES (Recommended)

### Update to Use New Pages

```php
// Login Routes (No Auth Required)
Route::get('/admin/login', fn() => view('admin.login-new'));
Route::post('/admin/login', [AuthController::class, 'login']);

// Protected Admin Routes
Route::middleware('auth:admin')->group(function () {
    
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    
    // Feedback Management
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.list');
    Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show'])->name('admin.feedback.detail');
    Route::post('/admin/feedback/{id}/respond', [FeedbackController::class, 'respond']);
    Route::post('/admin/feedback/{id}/status', [FeedbackController::class, 'updateStatus']);
    Route::delete('/admin/feedback/{id}/delete', [FeedbackController::class, 'destroy']);
    
    // Category Management
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories/store', [CategoryController::class, 'store']);
    Route::post('/admin/categories/{id}/update', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}/delete', [CategoryController::class, 'destroy']);
    
    // Export
    Route::get('/admin/export/csv', [ExportController::class, 'csv']);
    Route::get('/admin/export/pdf', [ExportController::class, 'pdf']);
    
    // Activity Logs
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs');
    Route::get('/admin/activity-logs/user/{username}', [ActivityLogController::class, 'user']);
    Route::get('/admin/activity-logs/failed', [ActivityLogController::class, 'failedLogins']);
    
    // User Profile
    Route::get('/admin/profile', fn() => view('admin.profile'))->name('admin.profile');
    Route::post('/admin/profile/change-password', [AuthController::class, 'changePassword']);
    
    // Settings
    Route::get('/admin/settings', fn() => view('admin.settings'))->name('admin.settings');
    Route::post('/admin/settings/general', [SettingsController::class, 'updateGeneral']);
    Route::post('/admin/settings/regional', [SettingsController::class, 'updateRegional']);
    Route::post('/admin/settings/security', [SettingsController::class, 'updateSecurity']);
    
    // Logout
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
```

---

## 📝 CHANGES EXPLAINED

### Dashboard
**Old**: `view('admin.dashboard')`  
**New**: `view('admin.dashboard-new')` via `DashboardController`

### Feedback Routes
**Old**: Single index/show routes  
**New**: Separate routes for list, detail, respond, status, delete

### Categories Routes
**Old**: Store/update used PUT  
**New**: Update uses POST, consistent with form handling

### New Routes Added
- Profile page route
- Settings page route
- Logout (POST instead of GET)

---

## 🔧 IMPLEMENTATION STEPS

### Step 1: Update routes/web.php

Replace existing admin routes with:

```php
// Protected Admin Routes
Route::middleware('auth:admin')->group(function () {
    
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    
    // Feedback
    Route::get('/admin/feedback', [FeedbackController::class, 'index']);
    Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show']);
    Route::post('/admin/feedback/{id}/respond', [FeedbackController::class, 'respond']);
    Route::post('/admin/feedback/{id}/status', [FeedbackController::class, 'updateStatus']);
    Route::delete('/admin/feedback/{id}/delete', [FeedbackController::class, 'destroy']);
    
    // Categories
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/categories/store', [CategoryController::class, 'store']);
    Route::post('/admin/categories/{id}/update', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}/delete', [CategoryController::class, 'destroy']);
    
    // Other routes...
});
```

### Step 2: Update Dashboard Controller

```php
class DashboardController extends Controller {
    public function index() {
        $data = [
            'totalFeedback' => Feedback::count(),
            'newFeedback' => Feedback::where('status', 'baru')->count(),
            // ... more data
        ];
        
        return view('admin.dashboard-new', $data);
    }
}
```

### Step 3: Update Feedback Controller

```php
class FeedbackController extends Controller {
    public function index() {
        $feedbacks = Feedback::latest()->paginate(15);
        $categories = Category::all();
        return view('admin.feedback.list', compact('feedbacks', 'categories'));
    }
    
    public function show($id) {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.detail', compact('feedback'));
    }
    
    public function respond(Request $request, $id) {
        $feedback = Feedback::findOrFail($id);
        $feedback->update(['admin_response' => $request->admin_response]);
        return redirect()->back()->with('success', 'Response saved');
    }
}
```

### Step 4: Update Category Controller

```php
class CategoryController extends Controller {
    public function index() {
        $categories = Category::withCount('feedbacks')->get();
        return view('admin.categories.list', compact('categories'));
    }
}
```

---

## 🔑 KEY DIFFERENCES

### Route Naming
All important routes now have names:
```php
->name('admin.dashboard')
->name('admin.feedback.list')
->name('admin.profile')
->name('admin.settings')
->name('admin.logout')
```

### Route Methods
- Login GET/POST (no auth required)
- Admin routes (auth required)
- Logout POST instead of GET (more secure)

### Route Parameters
- Feedback detail: `/admin/feedback/{id}`
- Feedback respond: `/admin/feedback/{id}/respond` (POST)
- Feedback status: `/admin/feedback/{id}/status` (POST)
- Feedback delete: `/admin/feedback/{id}/delete` (DELETE)

---

## ✅ TESTING CHECKLIST

After updating routes:

- [ ] Login page loads at `/admin/login`
- [ ] Dashboard loads at `/admin` after login
- [ ] Feedback list loads at `/admin/feedback`
- [ ] Feedback detail loads at `/admin/feedback/{id}`
- [ ] Categories page loads at `/admin/categories`
- [ ] Activity logs load at `/admin/activity-logs`
- [ ] Profile page loads at `/admin/profile`
- [ ] Settings page loads at `/admin/settings`
- [ ] Logout works
- [ ] All navigation links work
- [ ] All forms submit correctly

---

## 📌 IMPORTANT NOTES

### 1. Master Layout Extends
All pages now extend `admin.layout`:
```blade
@extends('admin.layout')
```

### 2. Navigation Auto-Updates
The sidebar in `layout.blade.php` automatically highlights active links based on route:
```blade
{{ request()->is('admin') || request()->is('admin/dashboard') ? 'active' : '' }}
```

### 3. View Paths
New view paths:
- `admin.dashboard-new` (dashboard)
- `admin.feedback.list` (feedback list)
- `admin.feedback.detail` (feedback detail)
- `admin.categories.list` (categories)
- `admin.activity-logs-new` (activity logs)
- `admin.profile` (profile)
- `admin.settings` (settings)
- `admin.login-new` (login)

---

## 🎯 MIGRATION STRATEGY

### Option 1: Full Migration
Replace all routes immediately with new structure.

**Pros**: Clean break, modern structure  
**Cons**: Need to update all controllers

### Option 2: Gradual Migration
Keep old routes working, add new routes in parallel.

**Pros**: No downtime, test gradually  
**Cons**: Maintain duplicate routes temporarily

### Recommended
**Full Migration** with thorough testing.

---

## 📊 EXAMPLE UPDATED ROUTES FILE

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\AuthController;

// PUBLIC ROUTES
Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback', function () {
    return view('feedback');
});

// ADMIN LOGIN
Route::get('/admin/login', fn() => view('admin.login-new'))->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);

// ADMIN PROTECTED ROUTES
Route::middleware('auth:admin')->group(function () {
    
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Feedback
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show']);
    Route::post('/admin/feedback/{id}/respond', [FeedbackController::class, 'respond']);
    Route::post('/admin/feedback/{id}/status', [FeedbackController::class, 'updateStatus']);
    Route::delete('/admin/feedback/{id}/delete', [FeedbackController::class, 'destroy']);
    
    // Categories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories/store', [CategoryController::class, 'store']);
    Route::post('/admin/categories/{id}/update', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}/delete', [CategoryController::class, 'destroy']);
    
    // Export
    Route::get('/admin/export/csv', [ExportController::class, 'csv']);
    Route::get('/admin/export/pdf', [ExportController::class, 'pdf']);
    
    // Activity Logs
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs');
    
    // Profile & Settings
    Route::get('/admin/profile', fn() => view('admin.profile'))->name('admin.profile');
    Route::get('/admin/settings', fn() => view('admin.settings'))->name('admin.settings');
    
    // Logout
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
```

---

## 🎓 BEST PRACTICES

### Use Route Names
```php
// Good
<a href="{{ route('admin.dashboard') }}">Dashboard</a>

// Avoid
<a href="/admin/dashboard">Dashboard</a>
```

### Use Resource Routes Where Applicable
```php
// Could be simplified to:
Route::resource('/admin/feedback', FeedbackController::class);
```

### Group Protected Routes
```php
// Good - all routes grouped together
Route::middleware('auth:admin')->group(function () {
    // All admin routes here
});
```

---

## 📚 NEXT STEPS

1. ✅ Review new pages and structure
2. ✅ Update routes/web.php
3. ✅ Update controllers to return new views
4. ✅ Test all pages and functionality
5. ✅ Test navigation and links
6. ✅ Deploy to production

---

**Status**: Implementation Guide Ready  
**Version**: 1.0  
**Created**: 27 November 2025

