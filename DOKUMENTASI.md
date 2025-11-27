# Website Dinas Ketahanan Pangan

## Deskripsi
Website profesional untuk Dinas Ketahanan Pangan dengan fitur Feedback Box yang memungkinkan masyarakat untuk mengirimkan saran, kritik, pertanyaan, dan pengaduan.

## Fitur Utama

### 1. Halaman Utama
- **Navigasi Responsif**: Menu dengan link smooth scroll ke berbagai bagian
- **Hero Section**: Banner dengan call-to-action yang menarik
- **Tentang Dinas**: Informasi visi, misi, dan tugas utama dinas
- **Program Unggulan**: 6 program utama dengan deskripsi
- **Berita Terbaru**: Display berita/update terbaru
- **Kontak**: Informasi alamat, telepon, email, dan jam kerja

### 2. Feedback Box (Kotak Saran)
- **Form Input Lengkap**:
  - Nama Lengkap (text input)
  - Email (email input dengan validasi)
  - Kategori (dropdown: Saran, Kritik, Pengaduan, Pertanyaan)
  - Pesan (textarea untuk feedback detail)
  
- **Validasi Real-time**: 
  - Hapus error message saat user mulai mengetik
  - Validasi server-side untuk keamanan

- **Notifikasi Sukses**: 
  - Tampilkan pesan "Terima kasih, saran Anda telah diterima."
  - Auto-refresh halaman setelah 2 detik

- **Penyimpanan Data**:
  - Simpan ke database SQLite
  - Catat IP address pengirim
  - Timestamp otomatis (created_at, updated_at)

### 3. Design & Responsivitas
- **Warna Profesional**: 
  - Hijau (#2ecc71) - Primary
  - Biru (#3498db) - Secondary
  - Putih (#ffffff) - Background
  - Gradien Biru-Hijau pada header dan footer

- **Responsive Breakpoints**:
  - Desktop (> 768px): Layout 2-3 kolom
  - Tablet (480px - 768px): Layout disesuaikan
  - Mobile (< 480px): Single column, menu optimized

- **Animasi & Hover Effects**:
  - Smooth scrolling untuk anchor links
  - Card hover effects dengan shadow dan transform
  - Notification slide-in animation
  - Gradient transitions

## Struktur Teknologi

### Backend (Laravel)
- **FeedbackController**: Menangani form submission dan penyimpanan data
- **Feedback Model**: Model database untuk tabel feedbacks
- **Migration**: Script untuk membuat tabel database
- **Routes**: Web routes untuk home dan API feedback

### Database
- **SQLite**: Database lokal (no setup needed)
- **Tabel feedbacks**: 
  - id (Primary Key)
  - name (string)
  - email (string)
  - category (enum: Saran, Kritik, Pengaduan, Pertanyaan)
  - message (text)
  - ip_address (string, nullable)
  - timestamps (created_at, updated_at)

### Frontend
- **HTML5**: Semantic markup
- **CSS3**: Custom styling dengan CSS variables
- **JavaScript**: Form handling & notifications
- **Fetch API**: AJAX untuk form submission

## Cara Menggunakan

### 1. Setup Awal
```bash
cd c:\xampp\htdocs\feedbackbox

# Install dependencies (jika belum)
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Jalankan migration
php artisan migrate
```

### 2. Menjalankan Server
```bash
# Menggunakan Laravel built-in server
php artisan serve

# Atau menggunakan PHP built-in server
php -S localhost:8000 -t public
```

### 3. Akses Website
Buka browser dan kunjungi: `http://localhost:8000`

## Endpoint API

### GET `/`
Menampilkan halaman utama website

**Response**: HTML page dengan form feedback

### POST `/feedback`
Menerima dan menyimpan feedback dari user

**Request Body**:
```json
{
  "name": "Nama Pengguna",
  "email": "user@example.com",
  "category": "Saran",
  "message": "Isi feedback minimal 10 karakter"
}
```

**Response Success** (200):
```json
{
  "success": true,
  "message": "Terima kasih, saran Anda telah diterima."
}
```

**Response Error** (422):
```json
{
  "errors": {
    "name": ["Nama harus diisi"],
    "email": ["Format email tidak valid"],
    "category": ["Kategori harus dipilih"],
    "message": ["Pesan minimal 10 karakter"]
  }
}
```

## Validasi Form

### Field Validasi:
- **Nama**: Required, max 255 characters
- **Email**: Required, valid email format, max 255 characters
- **Kategori**: Required, must be one of: Saran, Kritik, Pengaduan, Pertanyaan
- **Message**: Required, minimum 10 characters, maximum 5000 characters

## File Utama

- `resources/views/welcome.blade.php`: Halaman utama dengan HTML, CSS, dan JavaScript
- `app/Http/Controllers/FeedbackController.php`: Controller untuk menangani feedback
- `app/Models/Feedback.php`: Model Eloquent untuk tabel feedbacks
- `database/migrations/2025_11_25_000000_create_feedbacks_table.php`: Migration file
- `routes/web.php`: Web routes

## Fitur Keamanan

1. **CSRF Protection**: Token CSRF pada setiap form
2. **Input Validation**: Server-side validation untuk semua input
3. **IP Tracking**: Catat IP address pengguna
4. **Error Handling**: Pesan error yang aman tanpa expose informasi sensitive

## Browser Compatibility

- Chrome/Edge: ✓ Full support
- Firefox: ✓ Full support
- Safari: ✓ Full support
- IE 11: ✗ Not supported (ES6 JavaScript)

## Tips Customization

### Mengubah Warna
Edit `:root` CSS variables di `welcome.blade.php`:
```css
:root {
    --primary: #2ecc71;      /* Warna hijau */
    --secondary: #3498db;    /* Warna biru */
    --dark: #2c3e50;         /* Warna gelap */
    --white: #ffffff;        /* Warna putih */
}
```

### Menambah Program/Berita
Edit HTML di section `.programs` atau `.news` untuk menambah card baru.

### Mengubah Informasi Kontak
Edit section `.contact` dengan informasi kontak yang sebenarnya.

## Troubleshooting

### Form tidak submit
- Cek browser console untuk errors
- Pastikan CSRF token valid
- Cek network tab untuk response dari server

### Database error
- Pastikan SQLite sudah ter-install
- Cek folder `database/` memiliki permission write
- Jalankan `php artisan migrate --force` lagi

### Page tidak responsive
- Clear browser cache (Ctrl+Shift+Delete)
- Cek viewport meta tag di HTML
- Test di DevTools mobile view

## Support
Untuk bantuan lebih lanjut, hubungi tim development atau check Laravel documentation di https://laravel.com/docs
