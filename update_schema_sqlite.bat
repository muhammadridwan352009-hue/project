@echo off
echo ====================================================
echo  MEMPERBAIKI STRUKTUR DATABASE SQLITE SIMPATI
echo ====================================================

cd /d C:\xampp7\htdocs\simpati

echo 1. Menghapus database lama yang strukturnya belum lengkap...
if exist "database\database.sqlite" del /f /q "database\database.sqlite"
type nul > "database\database.sqlite"

echo 2. Migrasi ulang seluruh tabel dengan kolom lengkap...
"C:\xampp7\php\php.exe" artisan migrate:fresh --seed --force

echo.
echo ====================================================
echo  SELESAI! Tabel users sekarang sudah memiliki kolom nis,
echo  kelas, tingkat_kelas, jurusan, dan foto.
echo ====================================================
pause
