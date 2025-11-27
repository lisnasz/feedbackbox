# 🔐 ADMIN SEEDER - DOKUMENTASI

**Status**: ✅ Complete  
**Tanggal**: 27 November 2025  
**File**: `database/seeders/AdminSeeder.php`

---

## 📋 OVERVIEW

AdminSeeder adalah database seeder yang membuat user admin di dalam database sehingga admin bisa login ke admin dashboard dengan username dan password yang disimpan di database.

---

## 🎯 FITUR

✅ **Membuat Admin User**
- Membuat 2 user admin default
- Username berbasis email
- Password di-hash dengan bcrypt

✅ **Secure Credentials**
- Password di-hash menggunakan Laravel's Hash facade
- Tidak menyimpan password dalam plain text
- Compatible dengan authentication system

✅ **User Credentials**
```
Admin 1:
  Email: admin@feedbackbox.local
  Password: admin123

Admin 2:
  Email: superadmin@feedbackbox.local
  Password: superadmin123
```

✅ **Output Informatif**
- Menampilkan credentials saat seeding selesai
- User-friendly messages
- Easy reference

---

## 📁 LOKASI FILE

```
database/seeders/AdminSeeder.php
```

---

## 🚀 CARA MENGGUNAKAN

### 1. Run AdminSeeder Saja

```bash
php artisan db:seed --class=AdminSeeder
```

**Output**:
```
✅ Admin users created successfully!

Admin Credentials:
─────────────────────────────────────
Username 1: admin@feedbackbox.local
Password:   admin123

Username 2: superadmin@feedbackbox.local
Password:   superadmin123
─────────────────────────────────────
```

### 2. Run Semua Seeder (Recommended)

```bash
php artisan db:seed
```

Ini akan:
- Membuat admin users (AdminSeeder)
- Membuat categories (CategorySeeder)
- Membuat sample feedback (FeedbackSeeder)

### 3. Fresh Database dengan Seeders

```bash
php artisan migrate:refresh --seed
```

Ini akan:
- Drop semua tables
- Jalankan migrations
- Jalankan semua seeders

---

## 📊 DATABASE STRUCTURE

### Users Table
```sql
id              INTEGER PRIMARY KEY
name            VARCHAR NOT NULL
email           VARCHAR NOT NULL UNIQUE
password        VARCHAR NOT NULL
remember_token  VARCHAR NULL
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### Data yang Diinsert

| id | name | email | password (bcrypt) |
|----|------|-------|------------------|
| 1 | Administrator | admin@feedbackbox.local | hash('admin123') |
| 2 | Super Admin | superadmin@feedbackbox.local | hash('superadmin123') |

---

## 🔐 AUTHENTICATION FLOW

### AdminSeeder → Database → AuthController

```
┌─────────────────────┐
│   AdminSeeder       │
│  Creates Admin      │
│  Users in DB        │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│   Users Table       │
│  - id               │
│  - name             │
│  - email (unique)   │
│  - password (hash)  │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│  AuthController     │
│  - Verify email     │
│  - Check password   │
│  - Create session   │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│  Admin Dashboard    │
│  - Dashboard        │
│  - Feedback         │
│  - Categories       │
│  - Activity Logs    │
└─────────────────────┘
```

---

## 🔄 INTEGRATION DENGAN AUTH

### AuthController Login Logic

```php
// 1. Try to authenticate dari database
$user = User::where('email', $request->username)
            ->orWhere('name', $request->username)
            ->first();

if ($user && Hash::check($request->password, $user->password)) {
    // Login successful
    Session::put('admin', true);
    Session::put('admin_user_id', $user->id);
    Session::put('admin_username', $user->email);
    Session::put('admin_name', $user->name);
    // Redirect to dashboard
}

// 2. Fallback ke hardcoded credentials jika ada
if ($request->username === 'admin' && Hash::check($request->password, HARDCODED_HASH)) {
    // Login dengan hardcoded credentials
}
```

---

## 📝 KODE SEEDER

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user in database
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@feedbackbox.local'],
            [
                'name' => 'Administrator',
                'email' => 'admin@feedbackbox.local',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create super admin user
        DB::table('users')->updateOrInsert(
            ['email' => 'superadmin@feedbackbox.local'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@feedbackbox.local',
                'password' => Hash::make('superadmin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->command->info('✅ Admin users created successfully!');
        // ... output credentials
    }
}
```

---

## 🔑 LOGIN CREDENTIALS

### Default Admin Users

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| Admin | admin@feedbackbox.local | admin123 | Dashboard, Feedback, Categories, Logs |
| Super Admin | superadmin@feedbackbox.local | superadmin123 | Dashboard, Feedback, Categories, Logs |

### Login Lokasi

```
URL: http://localhost:8000/admin/login
```

### Login Form

```html
<input type="text" name="username" placeholder="Email atau Name">
<input type="password" name="password" placeholder="Password">
<button type="submit">Sign In</button>
```

---

## 🔐 SECURITY FEATURES

✅ **Password Hashing**
- Menggunakan bcrypt hashing
- Cost factor: 12 (Laravel default)
- Cannot be reversed

✅ **Database Storage**
- Password hanya disimpan dalam hash
- Tidak ada plaintext password di database

✅ **Rate Limiting**
- Max 5 login attempts per 15 minutes
- Per IP address
- Automatic blocking

✅ **Activity Logging**
- Login recorded dalam activity_logs
- Failed attempts tracked
- Complete audit trail

---

## 📊 MIGRASI DATA

### Jika ada user lama yang perlu di-update

```bash
php artisan tinker

# Di tinker shell:
$user = User::find(1);
$user->update(['password' => Hash::make('newpassword')]);
```

---

## 🛠️ TROUBLESHOOTING

### Problem: Admin tidak bisa login

**Solution**:
1. Pastikan AdminSeeder sudah dijalankan
2. Cek database users table: `sqlite3 database/database.sqlite "SELECT * FROM users;"`
3. Pastikan password benar: `admin123` atau `superadmin123`

### Problem: Seeder tidak jalan

**Solution**:
1. Pastikan migrations sudah dijalankan: `php artisan migrate`
2. Run seeder: `php artisan db:seed`

### Problem: "Unknown class AdminSeeder"

**Solution**:
1. Cek file: `database/seeders/AdminSeeder.php` ada
2. Refresh composer autoload: `composer dump-autoload`
3. Run seeder lagi

---

## 📈 NEXT STEPS

### 1. Jalankan Seeder
```bash
php artisan db:seed
```

### 2. Test Login
```
URL: http://localhost:8000/admin/login
Email: admin@feedbackbox.local
Password: admin123
```

### 3. Explore Dashboard
```
- Dashboard Analytics
- Feedback Management
- Category Management
- Activity Logs
```

### 4. (Optional) Tambah User Baru
Bisa tambah user di dashboard atau tinker:
```bash
php artisan tinker
$user = User::create([
    'name' => 'Admin Baru',
    'email' => 'admin.baru@feedbackbox.local',
    'password' => Hash::make('password123')
]);
```

---

## 🔗 RELATED FILES

| File | Deskripsi |
|------|-----------|
| `app/Http/Controllers/AuthController.php` | Authentication logic |
| `app/Models/User.php` | User model |
| `database/migrations/create_users_table.php` | Users table schema |
| `database/seeders/DatabaseSeeder.php` | Main seeder file |
| `resources/views/admin/login-new.blade.php` | Login page |

---

## ✅ CHECKLIST

- [x] AdminSeeder dibuat
- [x] DatabaseSeeder di-update
- [x] AuthController di-update untuk support database users
- [x] Admin users bisa login dari database
- [x] Activity logging terintegrasi
- [x] Dokumentasi lengkap

---

## 📚 RESOURCES

- [Laravel Authentication](https://laravel.com/docs/authentication)
- [Laravel Database Seeding](https://laravel.com/docs/seeding)
- [Laravel Hash](https://laravel.com/docs/hashing)
- [Laravel Database](https://laravel.com/docs/database)

---

**Status**: ✅ Complete & Ready to Use

Admin seeder siap untuk membuat admin users dan mereka bisa login ke admin dashboard!

