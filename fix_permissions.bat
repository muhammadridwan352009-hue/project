@echo off
echo ============================================
echo  SIMPATI - Fix Permissions dan Clear Cache
echo ============================================

:: Ambil ownership
echo [1/6] Mengambil kepemilikan folder storage...
takeown /f "C:\xampp7\htdocs\simpati\storage" /r /d y >nul 2>&1
takeown /f "C:\xampp7\htdocs\simpati\bootstrap\cache" /r /d y >nul 2>&1

:: Berikan hak akses penuh
echo [2/6] Memberikan hak akses penuh...
icacls "C:\xampp7\htdocs\simpati\storage" /grant Everyone:(OI)(CI)F /T >nul 2>&1
icacls "C:\xampp7\htdocs\simpati\bootstrap\cache" /grant Everyone:(OI)(CI)F /T >nul 2>&1

:: Hapus file log yang terkunci
echo [3/6] Menghapus file log lama...
del /f /q "C:\xampp7\htdocs\simpati\storage\logs\laravel.log" >nul 2>&1
del /f /q "C:\xampp7\htdocs\simpati\bootstrap\cache\config.php" >nul 2>&1
del /f /q "C:\xampp7\htdocs\simpati\bootstrap\cache\routes-v7.php" >nul 2>&1
del /f /q "C:\xampp7\htdocs\simpati\bootstrap\cache\events.php" >nul 2>&1

:: Buat ulang file log kosong
echo. > "C:\xampp7\htdocs\simpati\storage\logs\laravel.log"
icacls "C:\xampp7\htdocs\simpati\storage\logs\laravel.log" /grant Everyone:F >nul 2>&1

:: Rebuild cache Laravel
echo [4/6] Rebuild config cache...
"C:\xampp7\php\php.exe" "C:\xampp7\htdocs\simpati\artisan" config:cache

echo [5/6] Rebuild route cache...
"C:\xampp7\php\php.exe" "C:\xampp7\htdocs\simpati\artisan" route:cache

echo [6/6] Rebuild view cache...
"C:\xampp7\php\php.exe" "C:\xampp7\htdocs\simpati\artisan" view:cache

echo.
echo ============================================
echo  SELESAI! Silakan refresh browser Anda.
echo ============================================
pause
