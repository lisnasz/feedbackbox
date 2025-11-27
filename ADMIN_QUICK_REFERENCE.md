# ⚡ Admin Panel Quick Reference Card

## 🔑 Akses Awal
- **URL:** http://localhost:8000/admin/login
- **Username:** admin
- **Password:** admin123

---

## 🗺️ Navigation Map

```
┌─ Dashboard (/admin)
│   └─ View stats & quick links
│
├─ Feedback Management (/admin/feedback)
│   ├─ View all feedback
│   ├─ Search by name/email/message
│   ├─ Filter by status/category/date
│   └─ Click "Detail" to manage individual feedback
│
├─ Feedback Detail (/admin/feedback/{id})
│   ├─ View full message
│   ├─ Add/edit admin response
│   ├─ Change status (baru/diproses/selesai)
│   └─ Delete feedback
│
└─ Category Management (/admin/categories)
    ├─ Add new category
    ├─ Edit category
    └─ Delete category (if no feedback)
```

---

## ⌨️ Keyboard Shortcuts & Tips

| Aksi | Cara |
|------|------|
| Ke Dashboard | Klik logo/home di sidebar |
| Logout | Tombol logout di header |
| Filter ulang | Klik "↻ Reset" button |
| Edit kategori | Klik "✏️ Edit" lalu "💾 Simpan Perubahan" |
| Delete feedback | Klik "🗑️" button + konfirmasi |

---

## 📊 Dashboard Numbers Explained

| Stat | Makna | Action |
|------|-------|--------|
| Total Pengaduan | Semua feedback yang pernah masuk | - |
| Pengaduan Baru | Belum dibaca/diproses | Klik card atau "Pengaduan Baru" link |
| Sedang Diproses | Status "diproses" | Update saat selesai handle |
| Selesai | Status "selesai" | Already resolved |

---

## 🔎 Smart Search & Filter Tips

### Search (3 field sekaligus):
```
Cari "ketahanan pangan" 
→ Mencari di: nama pengirim, email, isi pesan
```

### Filter Status:
```
Pilih "Baru" 
→ Hanya tampil feedback yang belum diproses
```

### Filter Category:
```
Pilih "Pengaduan"
→ Hanya tampil kategori pengaduan
```

### Filter Date Range:
```
Dari: 2025-11-01
Hingga: 2025-11-30
→ Tampil feedback dalam periode tersebut
```

### Kombinasi Filter:
```
Search: "layanan" + Status: "Diproses" + Kategori: "Keluhan"
→ Feedback tentang "layanan" + sedang diproses + kategori keluhan
```

---

## ✅ Workflow Pengaduan Standar

### Step 1: Baca Pengaduan Baru
```
Dashboard → Klik "Pengaduan Baru"
atau
Dashboard → "Lihat Semua Pengaduan" → Filter Status "Baru"
```

### Step 2: Detail & Analisa
```
Tabel → Klik "Detail" button
Baca seluruh pesan & informasi pengirim
```

### Step 3: Buat Tanggapan
```
Scroll ke "Tanggapan Admin"
→ Tulis response di textarea
→ Klik "💾 Simpan Tanggapan"
(Status auto-change ke "Diproses")
```

### Step 4: Selesaikan
```
Scroll ke "Ubah Status"
→ Pilih "Selesai"
→ Klik "📝 Update Status"
```

---

## 🏷️ Category Management Quick Guide

### Tambah Kategori
```
1. Admin Panel → "Kelola Kategori"
2. Form "Tambah Kategori Baru"
   - Nama (wajib): Nama unik
   - Deskripsi (opsional): Penjelasan
3. Klik "➕ Tambah Kategori"
```

### Edit Kategori
```
1. Cari kategori di tabel
2. Klik "✏️ Edit"
3. Modal dialog terbuka
4. Edit nama/deskripsi
5. Klik "💾 Simpan Perubahan"
```

### Hapus Kategori
```
1. Cari kategori di tabel
2. Klik "🗑️ Hapus"
3. Jika ada feedback: ERROR (tidak bisa delete)
4. Jika kosong: Confirm → Deleted
```

---

## 🎨 UI Elements Reference

### Status Badge Colors
- 🔵 **Baru** (Blue) - Belum dibaca
- 🟠 **Diproses** (Orange) - Sedang ditangani
- 🟢 **Selesai** (Green) - Sudah resolved

### Button Icons
| Icon | Fungsi |
|------|--------|
| 📋 | Daftar/List |
| 📊 | Dashboard |
| 🏷️ | Kategori |
| ✏️ | Edit |
| 🗑️ | Delete |
| 💾 | Save |
| 📝 | Update |
| ✕ | Close |
| 🔍 | Search |
| ↻ | Reset |

---

## ⚠️ Important Notes

### Cannot Delete:
- ❌ Kategori yang punya feedback
- ❌ User lain's feedback (hanya own)

### Auto-Actions:
- ✅ Submit tanggapan → auto status "diproses"
- ✅ Delete kategori → soft delete (future)

### Validation Rules:
- Tanggapan minimal 10 karakter
- Nama kategori harus unik
- Email harus format valid

---

## 🆘 Quick Troubleshooting

| Problem | Solution |
|---------|----------|
| Kategori tidak muncul | Refresh page / db:seed ulang |
| Filter tidak kerja | Ada data yang sesuai? Cek lagi |
| Tidak bisa delete kategori | Hapus feedback nya dulu |
| Login gagal | Username: `admin`, Password: `admin123` |
| Tanggapan gagal save | Min 10 karakter? Check lagi |

---

## 📱 Mobile Tips

- Gunakan landscape mode untuk tabel lebih lebar
- Filter sidebar responsive - akan collapse di mobile
- Pagination swipe-friendly untuk navigasi

---

## 🔐 Security Reminders

- 🔒 JANGAN share credentials admin
- 🔒 Logout saat selesai kerja
- 🔒 Gunakan strong password di production
- 🔒 Clear browser cache jika masalah login

---

## 📞 Need Help?

1. **User Questions?** → Baca `ADMIN_PANEL_GUIDE.md`
2. **Technical Questions?** → Baca `ADMIN_TECHNICAL_DOCS.md`
3. **Not Covered?** → Contact IT Team

---

**Last Updated:** November 2025
**Version:** 1.0
**Status:** Ready to Use ✅
