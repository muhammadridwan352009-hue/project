@echo off
echo ====================================================
echo  MEMBUAT DATABASE & AKUN SISWA / PETUGAS (SQLITE)
echo ====================================================

cd /d C:\xampp7\htdocs\simpati

echo 1. Membuka izin file database...
attrib -r -s "database\database.sqlite" >nul 2>&1
attrib -r -s "database" >nul 2>&1

echo 2. Migrasi tabel database...
"C:\xampp7\php\php.exe" artisan migrate --force

echo 3. Mengisi data akun (Petugas dan Siswa)...
"C:\xampp7\php\php.exe" artisan db:seed --force

echo.
echo ====================================================
echo  SELESAI! Akun siswa dan petugas berhasil dibuat.
echo ====================================================
pause
