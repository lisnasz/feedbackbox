# Dokumentasi Fitur Keamanan dan Activity Logging

## 📋 Ringkasan

Sistem admin panel sekarang dilengkapi dengan fitur keamanan tingkat lanjut dan activity logging untuk audit trail yang komprehensif.

## 🔐 Fitur Keamanan

### 1. Password Hashing
- **Implementasi**: Menggunakan bcrypt untuk hashing password
- **Kredensial Default**:
  - Username: `admin`
  - Password: `admin123` (tersimpan sebagai hash bcrypt)
- **Lokasi**: `app/Http/Controllers/AuthController.php`

```php
const ADMIN_PASSWORD_HASH = '$2y$12$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86.FOULCnxi';
Hash::check($request->password, self::ADMIN_PASSWORD_HASH);
```

### 2. Rate Limiting Login
- **Maksimal Percobaan**: 5 kali login gagal
- **Jendela Waktu**: 15 menit
- **Aksi**: Blok login dan log percobaan
- **Mekanisme**: Memeriksa IP address dan history login gagal

```php
const MAX_LOGIN_ATTEMPTS = 5;
const RATE_LIMIT_MINUTES = 15;

$failedAttempts = ActivityLogService::getLoginAttempts(
    $request->ip(),
    self::RATE_LIMIT_MINUTES
);

if ($failedAttempts >= self::MAX_LOGIN_ATTEMPTS) {
    // Tolak login
}
```

### 3. Activity Logging
- **Pencatatan Otomatis**: Setiap aksi admin dicatat
- **Informasi Tercatat**:
  - Username admin
  - Jenis aksi (login, logout, view, update, delete)
  - Deskripsi detail
  - IP address pengguna
  - User agent (browser/client info)
  - Status (success, failed, error)
  - Timestamp

## 📝 Activity Log Service

### Lokasi
`app/Services/ActivityLogService.php`

### Method Utama

#### 1. `ActivityLogService::log()`
Mencatat aktivitas ke database

```php
ActivityLogService::log(
    string $username,
    string $action,
    ?string $description = null,
    ?string $status = 'success',
    ?Request $request = null
): void
```

**Contoh Penggunaan**:
```php
ActivityLogService::log(
    'admin',
    'login',
    'Login successful',
    'success',
    $request
);
```

#### 2. `ActivityLogService::getActivities()`
Mengambil log aktivitas dengan filter

```php
$logs = ActivityLogService::getActivities(
    ?string $username = null,
    ?string $action = null,
    ?int $limit = 50
);
```

#### 3. `ActivityLogService::getLoginAttempts()`
Menghitung percobaan login gagal dari IP tertentu

```php
$attempts = ActivityLogService::getLoginAttempts(
    string $ip,
    int $minutes = 15
): int
```

## 🖥️ Activity Log Dashboard

### URL
- **Main**: `/admin/activity-logs`
- **By User**: `/admin/activity-logs/user/{username}`
- **Failed Logins**: `/admin/activity-logs/failed`

### Fitur
- **Statistik**:
  - Total login sukses
  - Total login gagal
  - Total aktivitas
  - Jumlah admin unik
  
- **Tabel Aktivitas**:
  - Tanggal dan waktu
  - Username admin
  - Jenis aksi
  - Deskripsi
  - IP address
  - Status (Sukses/Gagal/Error)
  - Pagination untuk 50 log per halaman

## 🗄️ Database Schema

### Activity Logs Table
```sql
CREATE TABLE activity_logs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    admin_username VARCHAR(255) NOT NULL,
    action VARCHAR(255) NOT NULL,
    description TEXT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    status VARCHAR(50) DEFAULT 'success',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## 📊 Integrasi dengan Sistem

### Login Controller
- Mencatat setiap percobaan login (sukses atau gagal)
- Mengecek rate limiting sebelum memproses login
- Melogkan logout

### Feedback Controller
- Dapat ditambahkan untuk mencatat setiap aksi CRUD feedback
- Dapat ditambahkan untuk mencatat perubahan status

### Category Controller
- Dapat ditambahkan untuk mencatat CRUD kategori

## 🔒 Best Practices Implementasi

1. **Password Management**
   - Hash semua password dengan bcrypt
   - Jangan simpan plaintext password di config
   - Gunakan environment variables untuk credensial

2. **Rate Limiting**
   - Implement pada semua endpoint login
   - Gunakan IP address sebagai identifier
   - Sesuaikan threshold sesuai kebutuhan

3. **Activity Logging**
   - Log semua operasi sensitif
   - Simpan informasi context yang lengkap
   - Jangan log password atau data sensitif
   - Implement log rotation untuk menghemat disk

4. **Audit Trail**
   - Audit trail harus immutable (tidak bisa diubah)
   - Simpan log ke system yang terpisah
   - Implement backup regular

## 📈 Monitoring dan Audit

### Cara Mengecek Failed Login Attempts
```
Kunjungi: /admin/activity-logs/failed
```

### Cara Mengecek Aktivitas User Spesifik
```
Kunjungi: /admin/activity-logs/user/{username}
```

### Query Manual (via Tinker)
```php
php artisan tinker

// Total login gagal
\App\Models\ActivityLog::where('action', 'login')->where('status', 'failed')->count();

// IP dengan banyak percobaan gagal
\App\Models\ActivityLog::where('action', 'login')
    ->where('status', 'failed')
    ->groupBy('ip_address')
    ->selectRaw('ip_address, COUNT(*) as attempts')
    ->having('attempts', '>', 3)
    ->get();

// Aktivitas user spesifik dalam 24 jam terakhir
\App\Models\ActivityLog::where('admin_username', 'admin')
    ->where('created_at', '>=', now()->subDay())
    ->latest()
    ->get();
```

## 🚀 Future Enhancements

1. **Advanced Filtering**
   - Filter berdasarkan date range
   - Filter berdasarkan action type
   - Search description

2. **Security Features Tambahan**
   - Two-factor authentication (2FA)
   - Session management (timeout, device tracking)
   - IP whitelisting
   - Password policy enforcement

3. **Compliance**
   - GDPR compliance untuk data privacy
   - Log retention policies
   - Data encryption at rest

4. **Analytics**
   - Suspicious activity detection
   - Login pattern analysis
   - Export activity logs to CSV/PDF
