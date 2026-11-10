#!/bin/sh
set -e

echo "========================================"
echo " SIMPATI - Starting up..."
echo "========================================"

# --------------------------------------------------
# 1. Pastikan direktori storage ada (dari volume)
# --------------------------------------------------
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/database

# --------------------------------------------------
# 2. Pastikan file SQLite ada (dari volume /data)
# --------------------------------------------------
if [ ! -f /data/database.sqlite ]; then
    echo ">>> Membuat database SQLite baru di /data/database.sqlite..."
    touch /data/database.sqlite
fi

# Symlink atau salin database dari volume ke lokasi Laravel
ln -sf /data/database.sqlite /var/www/html/database/database.sqlite
chmod 664 /data/database.sqlite

# --------------------------------------------------
# 3. Set environment variables dari secrets Fly.io
# --------------------------------------------------
cat > /var/www/html/.env << EOF
APP_NAME=SIMPATI
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL:-https://simpati.fly.dev}

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=sqlite
DB_DATABASE=/data/database.sqlite

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_PATH=/

CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local

BROADCAST_CONNECTION=log
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@simpati.fly.dev"
MAIL_FROM_NAME="SIMPATI"
EOF

echo ">>> File .env berhasil dibuat."

# --------------------------------------------------
# 4. Set permissions
# --------------------------------------------------
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown www-data:www-data /data/database.sqlite

# --------------------------------------------------
# 5. Clear cache lama
# --------------------------------------------------
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# --------------------------------------------------
# 6. Jalankan migrasi database
# --------------------------------------------------
echo ">>> Menjalankan migrasi database..."
php artisan migrate --force --no-interaction
echo ">>> Migrasi selesai."

# --------------------------------------------------
# 7. Cache konfigurasi untuk produksi (lebih cepat)
# --------------------------------------------------
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ">>> Cache berhasil dibuat."
echo ">>> SIMPATI siap diakses!"
echo "========================================"

# --------------------------------------------------
# 8. Jalankan Supervisor (Nginx + PHP-FPM)
# --------------------------------------------------
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
