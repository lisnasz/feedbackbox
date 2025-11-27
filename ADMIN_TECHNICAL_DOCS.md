# Dokumentasi Teknis - Admin Panel

## 📋 Daftar Isi
1. [Arsitektur Sistem](#arsitektur-sistem)
2. [Database Schema](#database-schema)
3. [File Structure](#file-structure)
4. [Routes & Controllers](#routes--controllers)
5. [Models](#models)
6. [Views](#views)
7. [Keamanan](#keamanan)
8. [API Endpoints](#api-endpoints)

---

## Arsitektur Sistem

### Komponen Utama

```
┌─────────────────────────────────────────────┐
│         Admin Panel Feedback                │
├─────────────────────────────────────────────┤
│                                             │
│  ┌────────────────────────────────────┐   │
│  │   Public Website (welcome.blade)   │   │
│  │  - Form Feedback                   │   │
│  │  - Load Categories via API         │   │
│  └────────────────────────────────────┘   │
│                                             │
│  ┌────────────────────────────────────┐   │
│  │    Admin Panel (Protected)         │   │
│  │  - Login/Auth                      │   │
│  │  - Dashboard                       │   │
│  │  - Feedback Management             │   │
│  │  - Category Management             │   │
│  └────────────────────────────────────┘   │
│                                             │
│  ┌────────────────────────────────────┐   │
│  │    Database (SQLite)               │   │
│  │  - feedbacks table                 │   │
│  │  - categories table                │   │
│  │  - users table                     │   │
│  └────────────────────────────────────┘   │
│                                             │
└─────────────────────────────────────────────┘
```

### Technology Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 10+ (PHP 8.0+) |
| Database | SQLite |
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Authentication | Session-based (Simple) |
| API | RESTful JSON |

---

## Database Schema

### Tabel: feedbacks

```sql
CREATE TABLE feedbacks (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    category_id BIGINT UNSIGNED,
    message LONGTEXT NOT NULL,
    admin_response LONGTEXT NULLABLE,
    status VARCHAR(255) DEFAULT 'baru',
    ip_address VARCHAR(45) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
```

**Kolom Penting:**
- `status`: enum nilai [baru, diproses, selesai]
- `category_id`: referensi ke tabel categories
- `admin_response`: isi tanggapan admin untuk pengguna

### Tabel: categories

```sql
CREATE TABLE categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    description LONGTEXT NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Data Default:**
1. Saran
2. Kritik
3. Pengaduan
4. Pertanyaan

### Tabel: users

```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULLABLE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── FeedbackController.php        # Public feedback submission
│   │   ├── AuthController.php            # Admin login/logout
│   │   └── Admin/
│   │       ├── FeedbackController.php    # Admin feedback management
│   │       └── CategoryController.php    # Admin category management
│   └── Middleware/
│       └── CheckAdminAuth.php            # Admin authentication middleware
│
├── Models/
│   ├── Feedback.php                      # Feedback model with relationships
│   ├── Category.php                      # Category model
│   └── User.php
│
└── Providers/
    └── AppServiceProvider.php

database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   ├── 0001_01_01_000002_create_jobs_table.php
│   ├── 2025_11_25_000000_create_feedbacks_table.php
│   ├── 2025_11_26_000000_create_categories_table.php
│   └── 2025_11_26_000001_add_status_to_feedbacks_table.php
│
└── seeders/
    ├── DatabaseSeeder.php
    └── CategorySeeder.php

resources/
├── views/
│   ├── welcome.blade.php                 # Public website with feedback form
│   └── admin/
│       ├── login.blade.php               # Admin login page
│       ├── dashboard.blade.php           # Admin dashboard
│       ├── feedback/
│       │   ├── index.blade.php           # Feedback list with filters
│       │   └── show.blade.php            # Feedback detail view
│       └── categories/
│           └── index.blade.php           # Category management

routes/
└── web.php                               # All application routes

bootstrap/
└── app.php                               # Application bootstrap (middleware config)
```

---

## Routes & Controllers

### Route List

#### Public Routes
```
GET  /                                  # Homepage with feedback form
POST /feedback                          # Submit feedback
GET  /api/categories                    # Get all categories (JSON)
```

#### Admin Authentication Routes
```
GET  /admin/login                       # Show login form
POST /admin/login                       # Process login
POST /admin/logout                      # Logout
```

#### Admin Protected Routes (Require auth.admin middleware)
```
GET  /admin                             # Dashboard
GET  /admin/feedback                    # Feedback list with filters
GET  /admin/feedback/{id}               # Feedback detail view
POST /admin/feedback/{id}/status        # Update feedback status
POST /admin/feedback/{id}/response      # Add/update admin response
POST /admin/feedback/{id}/delete        # Delete feedback

GET  /admin/categories                  # Category list
POST /admin/categories                  # Create new category
POST /admin/categories/{id}             # Update category
POST /admin/categories/{id}/delete      # Delete category
```

### Controllers

#### FeedbackController
```php
// Public feedback submission
public function index()              # Return homepage view
public function store(Request $req)  # Store feedback (POST)
public function getCategories()      # Return categories JSON (API)
```

#### AuthController
```php
public function showLogin()          # Show login form
public function login(Request $req)  # Process login
public function logout()             # Logout
```

#### Admin\FeedbackController
```php
public function index(Request $req)       # List feedbacks with filters
public function show(Feedback $feedback)  # Show feedback detail
public function updateStatus(...)         # Update feedback status
public function addResponse(...)          # Add/update admin response
public function delete(...)               # Delete feedback
```

#### Admin\CategoryController
```php
public function index()                       # List categories
public function store(Request $req)           # Create category
public function update(Request $req, Category) # Update category
public function delete(Category)              # Delete category
```

---

## Models

### Feedback Model

```php
class Feedback extends Model
{
    protected $fillable = [
        'name', 'email', 'category_id', 'message',
        'ip_address', 'status', 'admin_response'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
```

**Relationships:**
- `category()` - BelongsTo Category

**Status Values:**
- `baru` - New feedback
- `diproses` - Being processed
- `selesai` - Completed

### Category Model

```php
class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
```

**Relationships:**
- `feedbacks()` - HasMany Feedback

---

## Views

### Public Views

#### welcome.blade.php
- Main website with feedback form
- Loads categories dynamically via API
- Handles form submission via AJAX
- Shows success/error notifications

### Admin Views

#### login.blade.php
- Simple login form with username/password
- Error message display
- Link back to homepage

#### dashboard.blade.php
- Statistics cards showing feedback counts
- Quick access links
- Sidebar navigation menu

#### feedback/index.blade.php
- Table with all feedbacks
- Search functionality (name/email/message)
- Filters: status, category, date range
- Pagination
- Detail view link

#### feedback/show.blade.php
- Full feedback information
- Admin response form
- Status update form
- Delete option
- Email link to contact sender

#### categories/index.blade.php
- Form to add new category
- Table listing all categories
- Edit button (modal form)
- Delete button with confirmation
- Feedback count per category

---

## Keamanan

### Authentication

**Jenis:** Session-based (Simple)

**Kredensial:**
- Hardcoded di AuthController (dapat dipindahkan ke .env)
- Default: admin/admin123

**Middleware:** CheckAdminAuth
- Memverifikasi session('admin') sebelum akses halaman admin
- Redirect ke login jika session tidak ada

### CSRF Protection

```html
<form method="POST">
    @csrf  <!-- Laravel auto-adds CSRF token -->
</form>
```

### Input Validation

**Public Feedback:**
```php
'name' => 'required|string|max:255'
'email' => 'required|email|max:255'
'category' => 'required|string|max:255'
'message' => 'required|string|min:10|max:5000'
```

**Admin Category:**
```php
'name' => 'required|unique:categories|max:255'
'description' => 'nullable|max:1000'
```

### SQL Injection Prevention

- Menggunakan Eloquent ORM (parameter binding)
- Tidak ada raw SQL queries
- Input validation di model level

---

## API Endpoints

### GET /api/categories

**Response:**
```json
[
    {
        "id": 1,
        "name": "Saran",
        "description": "Saran untuk perbaikan dan pengembangan",
        "created_at": "2025-11-26T10:30:00Z",
        "updated_at": "2025-11-26T10:30:00Z"
    },
    {
        "id": 2,
        "name": "Kritik",
        "description": "Kritik yang membangun untuk layanan kami",
        "created_at": "2025-11-26T10:30:00Z",
        "updated_at": "2025-11-26T10:30:00Z"
    }
]
```

### POST /feedback

**Request:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "category": 1,  // atau string "Saran"
    "message": "Saran untuk perbaikan sistem..."
}
```

**Response (Success):**
```json
{
    "success": true,
    "message": "Terima kasih, saran Anda telah diterima."
}
```

**Response (Error):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["Format email tidak valid"],
        "message": ["Pesan minimal 10 karakter"]
    }
}
```

---

## Deployment Checklist

- [ ] Update kredensial admin di .env atau AuthController
- [ ] Migrate database: `php artisan migrate --force`
- [ ] Seed categories: `php artisan db:seed`
- [ ] Set APP_DEBUG=false di .env
- [ ] Configure proper logging
- [ ] Setup email notifications (optional)
- [ ] Enable HTTPS
- [ ] Setup automated backups
- [ ] Monitor error logs

---

## Future Enhancements

1. **Email Notifications**
   - Notifikasi email kepada pengirim saat status berubah
   - Email kepada admin saat pengaduan baru masuk

2. **Dashboard Statistics**
   - Grafik pengaduan per kategori
   - Trend timeline pengaduan
   - Response time analytics

3. **Export Features**
   - Export feedback ke CSV/Excel
   - Export laporan per kategori/status

4. **User Authentication**
   - Database-based authentication
   - Multiple admin roles
   - Activity logging

5. **Mobile App**
   - Mobile-friendly admin panel
   - Push notifications
   - Offline mode

---

**Versi:** 1.0  
**Terakhir Diupdate:** November 2025  
**Maintenance Status:** Aktif
