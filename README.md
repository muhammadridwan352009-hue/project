# SIMPATI — Sistem Peminjaman Alat Inventaris Sekolah

**SMK Negeri 5 Surakarta**

Aplikasi web berbasis Laravel 12 untuk manajemen peminjaman alat inventaris sekolah.

## Fitur

- 🔐 Login terpadu (Petugas & Siswa)
- 📋 Manajemen inventaris barang dengan deskripsi
- 🛒 Katalog alat untuk siswa
- 📝 Sistem peminjaman & pengembalian alat
- ✅ Persetujuan akun siswa oleh petugas
- 📊 Laporan peminjaman

## Teknologi

- **Backend:** Laravel 12 (PHP 8.2)
- **Database:** SQLite
- **Frontend:** Blade + Bootstrap
- **Build:** Vite

## Cara Menjalankan Lokal (XAMPP)

```bash
cd C:\xampp7\htdocs\simpati
php artisan serve
```

Akses di: `http://127.0.0.1:8000`

## Deploy ke Internet

Lihat panduan lengkap di **[DEPLOYMENT.md](DEPLOYMENT.md)**

Platform yang didukung: **Fly.io** (gratis, SQLite + Persistent Volume)

## Akun Default

| Role    | Email              | Password  |
|---------|--------------------|-----------|
| Petugas | (sesuai setup awal)| (rahasia) |
| Siswa   | Daftar via halaman registrasi |

## Lisensi

MIT License — SMK Negeri 5 Surakarta © 2024
