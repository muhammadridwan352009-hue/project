# 🚀 Panduan Deploy SIMPATI ke Fly.io

## Prasyarat

Sebelum deploy, pastikan sudah install:
- **Git** — untuk push ke GitHub
- **flyctl** (Fly.io CLI) — untuk deploy ke server

---

## Langkah 1 — Install flyctl (CLI Fly.io)

Buka **PowerShell sebagai Administrator**, lalu jalankan:

```powershell
iwr https://fly.io/install.ps1 -useb | iex
```

Setelah selesai, restart terminal lalu cek:

```powershell
flyctl version
```

---

## Langkah 2 — Daftar / Login ke Fly.io

```powershell
flyctl auth signup
# atau jika sudah punya akun:
flyctl auth login
```

> Fly.io meminta verifikasi kartu kredit, **TIDAK akan dicharge** selama dalam batas free tier.

---

## Langkah 3 — Buat Aplikasi di Fly.io

Masuk ke folder proyek:

```powershell
cd C:\xampp7\htdocs\simpati
```

Buat aplikasi baru (hanya pertama kali):

```powershell
flyctl apps create simpati-smkn5
```

> Jika nama `simpati-smkn5` sudah dipakai orang lain, ganti dengan nama lain misal `simpati-app-2024`.
> **Penting:** Nama yang dipakai harus sama dengan nilai `app =` di `fly.toml`!

---

## Langkah 4 — Buat Persistent Volume (Penyimpanan SQLite)

```powershell
flyctl volumes create simpati_db --region sin --size 1
```

- `--region sin` = Singapore (server terdekat dari Indonesia)
- `--size 1` = 1 GB (cukup untuk SQLite)

---

## Langkah 5 — Set Environment Variables (Secrets)

```powershell
# Generate APP_KEY Laravel
flyctl secrets set APP_KEY="$(php -r "echo 'base64:'.base64_encode(random_bytes(32));")"

# Set URL aplikasi (ganti sesuai nama app kamu)
flyctl secrets set APP_URL="https://simpati-smkn5.fly.dev"
```

---

## Langkah 6 — Deploy!

```powershell
flyctl deploy
```

Proses ini akan:
1. Build Docker image
2. Upload ke Fly.io
3. Jalankan migrasi database otomatis
4. Start aplikasi

Tunggu sekitar **3-5 menit** untuk pertama kali deploy.

---

## Langkah 7 — Buka Aplikasi

```powershell
flyctl open
```

Atau buka browser ke: `https://simpati-smkn5.fly.dev`

---

## Update Aplikasi (Deploy Ulang)

Setiap kali ada perubahan kode:

```powershell
cd C:\xampp7\htdocs\simpati

# Push ke GitHub dulu
git add .
git commit -m "update: deskripsi perubahan"
git push origin main

# Lalu deploy ke Fly.io
flyctl deploy
```

---

## Monitoring & Logs

```powershell
# Lihat log realtime
flyctl logs

# Lihat status aplikasi
flyctl status

# SSH ke server (troubleshooting)
flyctl ssh console
```

---

## Troubleshooting

### ❌ Error: "App not found"
Pastikan nama di `fly.toml` (`app = "..."`) sama dengan nama app yang dibuat.

### ❌ Error: "No volume named simpati_db"
Jalankan `flyctl volumes create simpati_db --region sin --size 1`

### ❌ Halaman error 500 setelah deploy
Cek logs: `flyctl logs`
Kemungkinan penyebab:
- `APP_KEY` belum di-set → `flyctl secrets set APP_KEY="..."`
- Migrasi gagal → `flyctl ssh console` lalu `php artisan migrate --force`

### ❌ Database kosong setelah redeploy
Ini NORMAL jika volume belum ter-attach. Pastikan ada di `fly.toml`:
```toml
[[mounts]]
  source = "simpati_db"
  destination = "/data"
```

---

## Struktur File Deployment

```
simpati/
├── Dockerfile              ← Build image PHP + Nginx
├── fly.toml                ← Konfigurasi Fly.io
├── .dockerignore           ← File yang tidak di-upload
└── docker/
    ├── nginx.conf          ← Konfigurasi Nginx
    ├── default.conf        ← Virtual host Laravel
    ├── supervisord.conf    ← Process manager
    └── entrypoint.sh       ← Script startup (migrasi, cache, dll.)
```
