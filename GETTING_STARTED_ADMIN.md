# 🚀 Admin Panel - Getting Started Guide

## Welcome to Admin Panel! 👋

Selamat datang di admin panel Dinas Ketahanan Pangan. Panduan ini akan memandu Anda untuk memulai dalam 5 menit.

---

## ⏱️ 5-Minute Quick Start

### Step 1: Akses Admin Panel (1 menit)
1. Buka browser Anda
2. Kunjungi: **http://localhost:8000/admin/login**
3. Atau dari homepage → klik menu "Admin" di atas

### Step 2: Login (1 menit)
```
Username: admin
Password: admin123

→ Klik tombol "Login"
```

### Step 3: Jelajahi Dashboard (1 menit)
```
Anda akan melihat:
- Statistik total pengaduan (4 card)
- Quick access links untuk fitur utama
```

### Step 4: Lihat Pengaduan (1 menit)
```
Di sidebar kiri:
→ Klik "📋 Daftar Pengaduan"
→ Lihat tabel dengan semua pengaduan
```

### Step 5: Buka Detail Pengaduan (1 menit)
```
Di tabel:
→ Klik tombol "Detail" pada pengaduan apapun
→ Baca isi lengkap pengaduan
→ Tambah tanggapan admin jika ingin
```

**Total waktu: ~5 menit ✅**

---

## 🎯 Pekerjaan Pertama Anda

### Untuk Admin Baru yang Pertama Kali:

#### Sesi 1: Familiarize (30 menit)
```
1. Login ke admin panel
2. Telusuri semua halaman:
   - Dashboard
   - Daftar Pengaduan
   - Kelola Kategori
3. Baca struktur interface
```

#### Sesi 2: Feedback Management (30 menit)
```
1. Buka "Daftar Pengaduan"
2. Pilih 1 pengaduan status "Baru"
3. Klik "Detail"
4. Baca isi pengaduan
5. Tulis tanggapan di bagian "Tanggapan Admin"
6. Klik "💾 Simpan Tanggapan"
7. Update status ke "Diproses"
```

#### Sesi 3: Filtering & Search (20 menit)
```
1. Kembali ke "Daftar Pengaduan"
2. Coba fitur pencarian:
   - Cari nama pengirim
   - Cari email
   - Cari kata kunci pesan
3. Coba fitur filter:
   - Filter status "Selesai"
   - Filter kategori "Saran"
   - Filter tanggal tertentu
```

---

## 🧭 Navigation Guide

### Main Menu (Sidebar)
```
┌─────────────────────────────┐
│  📊 Dashboard               │ ← Overview & stats
├─────────────────────────────┤
│  📋 Daftar Pengaduan        │ ← Main work area
├─────────────────────────────┤
│  🏷️  Kelola Kategori        │ ← Settings
└─────────────────────────────┘
```

### Header
```
┌──────────────────────────────────────────┐
│ Admin Panel  |  Admin: username  | Logout│
└──────────────────────────────────────────┘
```

### Feedback List Page
```
Filter Section
├─ Search
├─ Status Filter
├─ Category Filter
└─ Date Range Filter

Data Section
├─ Table with feedback
└─ Pagination
```

---

## 💼 Daily Tasks & Workflows

### Morning Task: Check New Feedback
```
Dashboard
  → "Pengaduan Baru" quick link
    → Filter status: "Baru"
      → Read first feedback
        → Add response if needed
          → Update status to "Diproses"
```

### Afternoon Task: Process Pending
```
Dashboard
  → "Daftar Pengaduan"
    → Filter status: "Diproses"
      → Review responses
        → Mark as "Selesai" if done
```

### Weekly Task: Manage Categories
```
Sidebar → "Kelola Kategori"
  → Check if all needed categories exist
    → Add new if needed
      → Review category usage
```

---

## 🔧 Common Tasks & How To

### Task 1: Read New Feedback
```
📋 Daftar Pengaduan
  → Filter: Status = "Baru"
    → Klik tombol "Detail" pada pengaduan
      → Baca "Isi Pengaduan"
```

### Task 2: Respond to Feedback
```
Detail Pengaduan
  → Scroll ke "Tanggapan Admin"
    → Tulis di textarea
    → Klik "💾 Simpan Tanggapan"
    → Status auto-update ke "Diproses"
```

### Task 3: Search Specific Feedback
```
📋 Daftar Pengaduan
  → Field "Cari"
    → Ketik nama/email/keyword
      → Klik "🔍 Filter"
```

### Task 4: Add New Category
```
🏷️ Kelola Kategori
  → Form "Tambah Kategori Baru"
    → Nama: [masukkan nama]
    → Deskripsi: [opsional]
      → Klik "➕ Tambah Kategori"
```

### Task 5: Check Statistics
```
📊 Dashboard
  → Lihat 4 statistics cards
    → Total Pengaduan
    → Pengaduan Baru
    → Sedang Diproses
    → Selesai
```

---

## ❓ FAQ - Pertanyaan Sering Diajukan

### Q: Saya lupa password admin?
**A:** Reset tidak bisa via interface. Hubungi IT team untuk reset kredensial.

### Q: Bagaimana cara menghapus pengaduan?
**A:** Buka detail pengaduan → scroll ke bawah → klik "🗑️ Hapus Pengaduan" → confirm.

### Q: Bisakah saya ubah kategori pengaduan yang sudah dibuat?
**A:** Ya. Kelola Kategori → klik "✏️ Edit" → ubah → klik "💾 Simpan".

### Q: Apa yang harus saya lakukan dengan pengaduan baru?
**A:** Baca → Buat tanggapan → Update status → Tandai selesai saat semuanya done.

### Q: Bisakah kategori dihapus?
**A:** Hanya jika tidak ada pengaduan dengan kategori tersebut. Jika ada, system akan reject.

### Q: Apakah filter bisa dikombinasikan?
**A:** Ya. Gunakan search + filter status + filter kategori + filter tanggal sekaligus.

### Q: Bagaimana cara logout?
**A:** Klik tombol "Logout" di header (atas kanan).

### Q: Apakah data pengaduan tersimpan di database?
**A:** Ya. Semua pengaduan disimpan di database SQLite secara otomatis.

---

## 📚 Learn More

Untuk informasi lebih detail, baca dokumentasi lengkap:

- **Quick Reference** - Cheatsheet untuk daily use  
  → `ADMIN_QUICK_REFERENCE.md`

- **Complete Guide** - Panduan lengkap fitur  
  → `ADMIN_PANEL_GUIDE.md`

- **Technical Docs** - Untuk developer/IT  
  → `ADMIN_TECHNICAL_DOCS.md`

- **Implementation Summary** - Project overview  
  → `ADMIN_IMPLEMENTATION_SUMMARY.md`

---

## ✨ Tips & Tricks

### Tip 1: Gunakan Sidebar Menu
Sidebar di kiri membuat navigation lebih cepat daripada menu dropdown.

### Tip 2: Filter Sebelum Search
Filter status/kategori dulu, baru search keyword spesifik.

### Tip 3: Review Batch Pengaduan
Setiap pagi, cek "Pengaduan Baru" untuk handle batch sekaligus.

### Tip 4: Gunakan Quick Links
Dashboard memiliki quick links ke halaman penting.

### Tip 5: Bookmark Quick Reference
Bookmark `ADMIN_QUICK_REFERENCE.md` untuk lookup cepat.

---

## 🆘 Problem Solving

### Jika Anda Mengalami Masalah:

#### Problem: Login tidak berhasil
```
Solution:
1. Cek username & password benar (admin / admin123)
2. Clear browser cache
3. Coba browser lain
4. Hubungi IT jika masih gagal
```

#### Problem: Kategori tidak muncul di dropdown form publik
```
Solution:
1. Refresh page
2. Pastikan kategori sudah ditambahkan
3. Tunggu 5 detik agar API load
4. Atau hubungi IT
```

#### Problem: Tidak bisa delete kategori
```
Solution:
1. Cek apakah kategori punya pengaduan
2. Jika ada, hapus pengaduan nya dulu
3. Baru bisa hapus kategori kosong
```

#### Problem: Tanggapan tidak tersimpan
```
Solution:
1. Cek tanggapan minimal 10 karakter
2. Check internet connection
3. Coba lagi setelah beberapa saat
4. Hubungi IT jika persisten
```

---

## 🎓 Learning Checklist

Gunakan checklist ini untuk track progress Anda:

- [ ] Saya sudah login ke admin panel
- [ ] Saya bisa navigate ke semua halaman
- [ ] Saya bisa melihat daftar pengaduan
- [ ] Saya bisa buka detail pengaduan
- [ ] Saya bisa tulis tanggapan admin
- [ ] Saya bisa ubah status pengaduan
- [ ] Saya bisa search pengaduan
- [ ] Saya bisa filter pengaduan
- [ ] Saya bisa tambah kategori
- [ ] Saya bisa edit kategori
- [ ] Saya bisa hapus kategori (kosong)
- [ ] Saya sudah familiar dengan interface

**Jika semua checked ✅ → Anda siap untuk daily operations!**

---

## 📞 Support & Help

### Need Help?
1. Baca dokumentasi yang sesuai
2. Cek bagian FAQ di dokumen ini
3. Lihat troubleshooting section
4. Hubungi tim IT jika masalah teknis

### Contact IT Team
```
Email: it@dinkp.garut
Telp: (0262) 2801757
Lokasi: Jl. Terusan Pahlawan No.70
```

---

## 🎯 Next Steps

### Sekarang, Anda sudah siap untuk:
1. ✅ Login ke admin panel
2. ✅ Navigate interface
3. ✅ Handle pengaduan baru
4. ✅ Manage kategori
5. ✅ Search & filter data

### Langkah selanjutnya:
- Mulai handle pengaduan harian
- Baca dokumentasi lebih dalam saat butuh
- Familiarize dengan workflow standar
- Tanyakan ke senior/IT untuk best practices

---

## 🎉 Congratulations!

Anda sekarang adalah **Admin Panel User** yang siap! 🎊

Selamat melayani masyarakat melalui sistem pengaduan modern ini.

**Happy Admin-ing! 😊**

---

**Version:** 1.0  
**Last Updated:** November 2025  
**Status:** Ready to Use ✅

---

## Quick Links

- [🔑 Quick Reference Card](ADMIN_QUICK_REFERENCE.md)
- [📖 Full User Guide](ADMIN_PANEL_GUIDE.md)
- [📚 Documentation Index](ADMIN_DOCUMENTATION_INDEX.md)
- [🏠 Back to Home](/)
