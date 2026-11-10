#!/bin/sh
set -e

echo "========================================"
echo " SIMPATI - Starting up..."
echo "========================================"

# --------------------------------------------------
# 1. Gunakan PORT dari environment (Railway inject ini)
#    Default ke 8080 jika tidak ada
# --------------------------------------------------
PORT=${PORT:-8080}

# Update nginx config dengan port yang benar
sed -i "s/listen 8080;/listen ${PORT};/g" /etc/nginx/http.d/default.conf

echo ">>> Server akan berjalan di port: $PORT"

# --------------------------------------------------
# 2. Pastikan direktori storage & runtime ada
# --------------------------------------------------
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/database
mkdir -p /var/log/supervisor
mkdir -p /run/nginx /var/run /var/log/nginx

# --------------------------------------------------
# 3. Setup file SQLite
# --------------------------------------------------
# Cek apakah ada volume persistent (Fly.io)
if [ -d "/data" ]; then
    echo ">>> Volume /data ditemukan (Fly.io mode)"
    if [ ! -f /data/database.sqlite ]; then
        echo ">>> Membuat database SQLite baru di /data/database.sqlite..."
        touch /data/database.sqlite
    fi
    ln -sf /data/database.sqlite /var/www/html/database/database.sqlite
    DB_PATH="/data/database.sqlite"
else
    echo ">>> Menggunakan database SQLite lokal (Railway mode)"
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
    DB_PATH="/var/www/html/database/database.sqlite"
fi

chmod 664 "$DB_PATH" 2>/dev/null || true

# --------------------------------------------------
# 4. Buat file .env dari environment variables
# --------------------------------------------------
cat > /var/www/html/.env << EOF
APP_NAME=SIMPATI
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL:-https://simpati.up.railway.app}

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=sqlite
DB_DATABASE=${DB_PATH}

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_PATH=/

CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local

BROADCAST_CONNECTION=log
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@simpati.app"
MAIL_FROM_NAME="SIMPATI"
EOF

echo ">>> File .env berhasil dibuat."

# --------------------------------------------------
# 5. Set permissions
# --------------------------------------------------
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

# --------------------------------------------------
# 6. Clear cache lama
# --------------------------------------------------
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# --------------------------------------------------
# 7. Jalankan migrasi database
# --------------------------------------------------
echo ">>> Menjalankan migrasi database..."
php artisan migrate --force --no-interaction
echo ">>> Migrasi selesai."

# --------------------------------------------------
# 8. Cache untuk produksi (lebih cepat)
# --------------------------------------------------
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ">>> Cache berhasil dibuat."
echo ">>> SIMPATI siap! Port: $PORT"
echo "========================================"

# --------------------------------------------------
# 9. Jalankan Supervisor (Nginx + PHP-FPM)
# --------------------------------------------------
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
