# 🌾 Website Dinas Ketahanan Pangan

Website profesional, responsif, dan mudah digunakan untuk Dinas Ketahanan Pangan dengan fitur Feedback Box terintegrasi.

## ✨ Fitur Utama

### 🏠 Halaman Utama
- **Header Navigasi**: Menu responsif dengan link smooth scroll
- **Hero Section**: Banner menarik dengan call-to-action
- **Tentang Kami**: Informasi visi, misi, dan tugas utama dinas
- **Program Unggulan**: 6 program unggulan dengan card design
  - Pertanian Modern
  - Gizi Seimbang
  - Keamanan Pangan
  - Pengolahan Pangan
  - Distribusi Pangan
  - Edukasi Masyarakat
- **Berita Terbaru**: 3 berita/update terkini
- **Kontak**: Informasi lengkap dinas (alamat, telepon, email, jam kerja)

### 📝 Feedback Box (Kotak Saran)
Fitur unggulan untuk menerima masukan dari masyarakat:

#### Form Fields:
1. **Nama Lengkap** - Text input untuk identitas pengirim
2. **Email** - Email input dengan validasi format
3. **Kategori** - Dropdown pilihan:
   - Saran
   - Kritik
   - Pengaduan
   - Pertanyaan
4. **Pesan** - Textarea untuk deskripsi detail (min 10 karakter)

#### Fitur Form:
- ✓ Real-time error clearing
- ✓ Validasi input server-side
- ✓ CSRF protection
- ✓ Loading state pada submit button
- ✓ Smooth animations

#### Notifikasi:
- Pesan sukses: "Terima kasih, saran Anda telah diterima."
- Notifikasi slide-in dari kanan atas
- Auto-dismiss setelah 3 detik
- Page refresh otomatis setelah 2 detik

### 📊 Penyimpanan Data
- **Database**: SQLite (built-in, no setup needed)
- **Tabel**: feedbacks
- **Fields**: 
  - id (integer, primary key)
  - name (string)
  - email (string)
  - category (enum)
  - message (text)
  - ip_address (string)
  - created_at (timestamp)
  - updated_at (timestamp)

### 🎨 Design & Styling

#### Warna Dominan:
- **Hijau (#2ecc71)**: Primary color untuk accent
- **Biru (#3498db)**: Secondary color untuk gradien
- **Putih (#ffffff)**: Background utama
- **Gradient Biru-Hijau**: Header dan feedback section

#### Responsive Design:
- **Desktop** (> 768px): Layout full dengan grid multi-kolom
- **Tablet** (480px - 768px): Layout adaptif
- **Mobile** (< 480px): Single column, menu optimized

#### Animasi:
- Smooth scrolling dengan `scroll-behavior: smooth`
- Card hover effects (transform + shadow)
- Notification slide-in animation
- Button hover effects dengan shadow
- Gradient transitions

## 🚀 Quick Start

### Prasyarat
- PHP 8.0+
- Composer
- Laravel 10+
- Node.js (optional, for assets)

### Instalasi

```bash
# 1. Navigate ke project directory
cd c:\xampp\htdocs\feedbackbox

# 2. Install dependencies
composer install

# 3. Copy environment file (jika belum ada)
copy .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Setup database (sudah dikonfigurasi ke SQLite)
php artisan migrate

# 6. Start development server
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

### Alternatif: Menggunakan XAMPP

```bash
# 1. Pastikan XAMPP Apache aktif
# 2. Akses via browser
http://localhost/feedbackbox/public

# 3. Atau gunakan built-in server
php artisan serve --host 0.0.0.0 --port 8000
```

## 📁 Struktur Project

```
feedbackbox/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── FeedbackController.php     # Handle form feedback
│   └── Models/
│       └── Feedback.php                   # Model database
├── config/
│   └── database.php                       # Database configuration
├── database/
│   └── migrations/
│       └── 2025_11_25_000000_create_feedbacks_table.php
├── resources/
│   └── views/
│       └── welcome.blade.php              # Main page (HTML+CSS+JS)
├── routes/
│   └── web.php                            # Web routes
├── public/
│   └── index.php                          # Entry point
├── .env                                   # Environment variables
└── DOKUMENTASI.md                         # Full documentation
```

## 🔌 API Endpoints

### GET `/`
Menampilkan halaman utama dengan form feedback.

**Response**: HTML page (200 OK)

### POST `/feedback`
Submit feedback ke server.

**Headers Required**:
```
Content-Type: application/x-www-form-urlencoded
X-CSRF-TOKEN: {token}
```

**Request Body**:
```
name=John Doe&email=john@example.com&category=Saran&message=Ini adalah saran untuk dinas
```

**Success Response** (200):
```json
{
  "success": true,
  "message": "Terima kasih, saran Anda telah diterima."
}
```

**Error Response** (422):
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": ["Nama harus diisi"],
    "email": ["Format email tidak valid"],
    "category": ["Kategori harus dipilih"],
    "message": ["Pesan minimal 10 karakter"]
  }
}
```

## ✅ Validasi Input

| Field | Type | Rules | Error Message |
|-------|------|-------|---|
| name | text | required, max:255 | Nama harus diisi |
| email | email | required, email, max:255 | Format email tidak valid |
| category | select | required, in:Saran,Kritik,Pengaduan,Pertanyaan | Kategori harus dipilih |
| message | textarea | required, min:10, max:5000 | Pesan minimal 10 karakter |

## 🔒 Security Features

1. **CSRF Protection**: Token validation pada setiap form submission
2. **Input Validation**: Server-side validation untuk semua fields
3. **Email Validation**: Format email divalidasi
4. **IP Tracking**: IP address pengirim tercatat untuk audit
5. **Error Handling**: Tidak menampilkan sensitive information

## 📱 Browser Support

| Browser | Status | Version |
|---------|--------|---------|
| Chrome | ✓ Supported | Latest 2 versions |
| Firefox | ✓ Supported | Latest 2 versions |
| Safari | ✓ Supported | Latest 2 versions |
| Edge | ✓ Supported | Latest 2 versions |
| IE 11 | ✗ Not supported | - |

## 🎯 Customization

### Mengubah Warna
Edit CSS variables di `resources/views/welcome.blade.php`:

```css
:root {
    --primary: #2ecc71;      /* Warna hijau */
    --secondary: #3498db;    /* Warna biru */
    --dark: #2c3e50;         /* Warna gelap */
    --light: #ecf0f1;        /* Warna terang */
    --white: #ffffff;        /* Putih */
}
```

### Mengubah Informasi Dinas
Edit konten di section `.about` dan `.contact` di halaman utama.

### Menambah Program/Berita
Tambahkan card baru di `.program-grid` atau `.news-grid`:

```html
<div class="program-card">
    <h3>🎯 Nama Program</h3>
    <p>Deskripsi program di sini...</p>
</div>
```

### Mengubah Brand/Logo
Edit di `.logo` class atau ganti emoji:

```html
<a href="/" class="logo">🌾 Dinas Ketahanan Pangan</a>
```

## 🛠️ Troubleshooting

### Port 8000 sudah digunakan
```bash
php artisan serve --port 8001
```

### Database error saat migrate
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear

# Run migrate lagi
php artisan migrate --force
```

### Form tidak bisa submit
- Cek browser console untuk errors
- Pastikan CSRF token ada di HTML
- Verify POST endpoint di network tab
- Check server logs dengan `php artisan serve`

### Page tidak responsive
- Clear browser cache (Ctrl+Shift+Delete)
- Test di Chrome DevTools mobile view
- Verifikasi viewport meta tag

### Feedback tidak tersimpan
- Cek database file `database/database.sqlite` ada
- Verify permissions folder `database/` writable
- Check application error log: `storage/logs/laravel.log`

## 📊 Monitoring Feedback

Untuk melihat semua feedback yang diterima, bisa mengakses endpoint (bisa ditambahkan middleware):

```bash
php artisan tinker
App\Models\Feedback::all();
```

Atau buat admin panel untuk menampilkan feedback:

```php
Route::get('/admin/feedback', function () {
    return App\Models\Feedback::latest()->get();
});
```

## 📝 Environment Variables

Key variables di `.env`:
```
APP_NAME=Dinas Ketahanan Pangan
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

SESSION_DRIVER=database
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

## 🔄 Updates & Maintenance

### Backup Database
```bash
# Copy database file
copy database/database.sqlite database/database_backup.sqlite
```

### Restore Database
```bash
# Fresh migration
php artisan migrate:refresh --force
```

## 📞 Support & Help

- **Laravel Documentation**: https://laravel.com/docs
- **Laravel Community**: https://laracasts.com
- **Database Issues**: Check SQLite documentation

## 📄 License

This project is open source and available under the MIT license.

## 👨‍💻 Developer Notes

- Menggunakan Laravel 10+ dengan Blade templating
- CSS custom tanpa framework (pure CSS untuk kontrol penuh)
- JavaScript vanilla untuk compatibility maksimal
- SQLite sebagai default database (mudah deploy)
- Form validation dengan Laravel built-in validator

---

**Status**: Production Ready ✓
**Last Updated**: November 25, 2025
**Version**: 1.0.0
