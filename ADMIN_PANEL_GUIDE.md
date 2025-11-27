# Admin Panel - Panduan Pengguna

## 📋 Daftar Isi
1. [Login Admin](#login-admin)
2. [Dashboard](#dashboard)
3. [Manajemen Pengaduan](#manajemen-pengaduan)
4. [Manajemen Kategori](#manajemen-kategori)
5. [Fitur Pencarian & Filter](#fitur-pencarian--filter)
6. [Akses Cepat](#akses-cepat)

---

## Login Admin

### Cara Akses
1. Buka browser dan kunjungi: `http://localhost:8000/admin/login`
2. Atau dari halaman utama, klik menu "Admin" di navigasi atas

### Kredensial Default
- **Username:** admin
- **Password:** admin123

> **Catatan Keamanan:** Sebaiknya ganti password default ini di lingkungan produksi melalui file `.env` atau database management system.

---

## Dashboard

Dashboard adalah halaman utama admin yang menampilkan ringkasan statistik pengaduan.

### Informasi yang Ditampilkan

1. **Total Pengaduan** - Jumlah seluruh pengaduan yang masuk
2. **Pengaduan Baru** - Pengaduan dengan status "Baru"
3. **Sedang Diproses** - Pengaduan dengan status "Diproses"
4. **Selesai** - Pengaduan dengan status "Selesai"

### Akses Cepat
- **Lihat Semua Pengaduan** - Menuju halaman daftar lengkap
- **Pengaduan Baru** - Filter langsung ke pengaduan baru
- **Kelola Kategori** - Mengelola kategori pengaduan

---

## Manajemen Pengaduan

### Daftar Pengaduan

#### Navigasi
Menu Sidebar → "📋 Daftar Pengaduan" atau dari Dashboard

#### Informasi Kolom
| Kolom | Deskripsi |
|-------|-----------|
| Nama | Nama pengirim pengaduan |
| Email | Email pengirim untuk respons |
| Kategori | Kategori pengaduan (Saran/Kritik/Pengaduan/Pertanyaan) |
| Status | Status pengaduan (Baru/Diproses/Selesai) |
| Tanggal | Tanggal dan jam pengaduan diterima |
| Aksi | Tombol untuk melihat detail |

### Detail Pengaduan

Klik tombol "Detail" untuk membuka halaman lengkap pengaduan.

#### Informasi yang Tersedia

**Bagian Informasi:**
- Nama pengirim
- Email pengirim
- Kategori
- Status saat ini
- Tanggal diterima
- IP Address pengirim

**Bagian Isi Pengaduan:**
- Menampilkan pesan lengkap dari pengirim

**Bagian Tanggapan Admin:**
- Menampilkan tanggapan admin (jika ada)
- Form untuk menambah atau mengedit tanggapan

**Pengubahan Status:**
- Dropdown untuk mengubah status ke: Baru, Diproses, atau Selesai
- Tombol "Update Status" untuk menyimpan perubahan

**Aksi Lainnya:**
- Tombol untuk menghapus pengaduan

### Workflow Pengaduan Standar

1. **Pengaduan Masuk** → Status: "Baru"
2. **Admin Membaca** → Status diubah menjadi: "Diproses"
3. **Admin Membuat Tanggapan** → Tanggapan ditambahkan ke sistem
4. **Selesai Ditangani** → Status diubah menjadi: "Selesai"

---

## Manajemen Kategori

### Akses Menu
Menu Sidebar → "🏷️ Kelola Kategori"

### Daftar Kategori Standar (Default)
1. **Saran** - Saran untuk perbaikan dan pengembangan
2. **Kritik** - Kritik yang membangun untuk layanan
3. **Pengaduan** - Pengaduan tentang layanan atau produk
4. **Pertanyaan** - Pertanyaan terkait dinas atau layanan

### Menambah Kategori Baru

1. Masuk ke halaman "Kelola Kategori"
2. Isi form di bagian "Tambah Kategori Baru":
   - **Nama Kategori** (Wajib) - Nama unik untuk kategori
   - **Deskripsi** (Opsional) - Penjelasan kategori
3. Klik tombol "➕ Tambah Kategori"
4. Kategori baru akan muncul di daftar

### Mengedit Kategori

1. Klik tombol "✏️ Edit" pada kategori yang ingin diubah
2. Modal dialog akan terbuka dengan form edit
3. Ubah nama atau deskripsi sesuai kebutuhan
4. Klik tombol "💾 Simpan Perubahan"

### Menghapus Kategori

1. Klik tombol "🗑️ Hapus" pada kategori yang ingin dihapus
2. Sistem akan menampilkan konfirmasi
3. Jika kategori memiliki pengaduan, sistem tidak akan mengizinkan penghapusan
4. Jika kosong, kategori akan dihapus

---

## Fitur Pencarian & Filter

### Pencarian

**Cari (Nama/Email/Pesan):**
- Cari pengaduan berdasarkan nama pengirim
- Cari berdasarkan email pengirim
- Cari berdasarkan kata kunci dalam pesan pengaduan

### Filter

**Berdasarkan Status:**
- Semua Status (default)
- Baru
- Sedang Diproses
- Selesai

**Berdasarkan Kategori:**
- Semua Kategori (default)
- Saran
- Kritik
- Pengaduan
- Pertanyaan
- (+ Kategori kustom yang ditambahkan)

**Berdasarkan Tanggal:**
- Dari Tanggal - Filter pengaduan dari tanggal tertentu
- Hingga Tanggal - Filter pengaduan hingga tanggal tertentu

### Cara Menggunakan Filter

1. Pilih kriteria filter yang diinginkan
2. Klik tombol "🔍 Filter" untuk menerapkan
3. Tabel akan diperbarui menampilkan hasil filter
4. Klik tombol "↻ Reset" untuk menghapus semua filter

### Kombinasi Filter

Anda dapat menggabungkan beberapa filter sekaligus:
- Cari "ketahanan pangan" + Status "Diproses"
- Kategori "Pengaduan" + Tanggal dari 01/11/2025 hingga 30/11/2025
- dsb.

---

## Fitur Tanggapan & Notifikasi

### Menambah Tanggapan

1. Buka detail pengaduan
2. Scroll ke bagian "Tanggapan Admin"
3. Isi textarea dengan tanggapan Anda
4. Klik tombol "💾 Simpan Tanggapan"
5. Sistem akan otomatis mengubah status menjadi "Diproses"

### Update Status Manual

Anda dapat mengubah status tanpa menambah tanggapan:
1. Scroll ke bagian "Ubah Status Pengaduan"
2. Pilih status baru
3. Klik tombol "📝 Update Status"

---

## Akses Cepat

### Dari Dashboard
- **Lihat Semua Pengaduan** - Buka halaman daftar lengkap
- **Pengaduan Baru** - Langsung ke filter pengaduan baru
- **Kelola Kategori** - Buka manajemen kategori

### Dari Sidebar Menu
1. 📊 **Dashboard** - Kembali ke halaman utama
2. 📋 **Daftar Pengaduan** - Lihat semua pengaduan
3. 🏷️ **Kelola Kategori** - Kelola kategori pengaduan

---

## Tips & Trik

### Produktivitas
1. Gunakan filter status "Baru" untuk fokus pada pengaduan baru
2. Kombinasikan pencarian + tanggal untuk menemukan pengaduan spesifik
3. Update status segera setelah membaca pengaduan

### Manajemen Kategori
1. Buat kategori yang spesifik dan jelas
2. Hindari duplikasi nama kategori
3. Jangan hapus kategori yang masih memiliki pengaduan
4. Gunakan deskripsi yang informatif

### Penanganan Pengaduan
1. Selalu baca pengaduan hingga selesai
2. Berikan tanggapan yang konstruktif dan profesional
3. Update status secara berkala untuk transparansi
4. Jika perlu diskusi internal, catat di tanggapan admin

---

## Troubleshooting

### Login Gagal
- Pastikan username dan password benar
- Periksa koneksi internet
- Clear cache browser jika perlu

### Kategori Tidak Muncul
- Refresh halaman
- Pastikan kategori sudah ditambahkan terlebih dahulu
- Jika masih gagal, bisa jadi ada error di database

### Filter Tidak Bekerja
- Pastikan ada data pengaduan yang sesuai kriteria
- Reset filter dan coba lagi
- Periksa konsol browser untuk error message

---

## Kontak & Dukungan

Jika mengalami masalah teknis:
1. Hubungi bagian IT internal
2. Sertakan screenshot atau detail error
3. Jelaskan langkah yang dilakukan sebelum error terjadi

---

**Versi:** 1.0  
**Terakhir Diupdate:** November 2025  
**Status:** Aktif & Berfungsi Penuh
