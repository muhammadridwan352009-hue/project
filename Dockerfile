# ============================================================
# SIMPATI - Dockerfile untuk Railway / Fly.io
# Laravel 12 + PHP 8.2 + SQLite + Nginx
# ============================================================

FROM php:8.2-fpm-alpine

# Install dependencies sistem
RUN apk add --no-cache \
    nginx \
    supervisor \
    sqlite \
    sqlite-dev \
    nodejs \
    npm \
    git \
    unzip \
    curl \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        gd \
        zip \
        opcache

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Salin composer files dulu (untuk cache layer Docker)
COPY composer.json composer.lock ./

# Install PHP dependencies (tanpa dev, tanpa scripts dulu)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Salin package.json untuk npm
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts

# Salin semua file aplikasi
COPY . .

# ============================================================
# FIX: Buat direktori SEBELUM composer dump-autoload
# (composer scripts seperti package:discover butuh direktori ini)
# ============================================================
RUN mkdir -p \
    bootstrap/cache \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    database \
    /var/log/supervisor \
    /run/nginx

# Build assets Vite (CSS/JS)
RUN npm run build

# Jalankan composer autoload dan scripts (SETELAH direktori dibuat)
RUN composer dump-autoload --optimize --no-dev

# Salin .env.example sebagai .env default
RUN cp .env.example .env

# Buat file SQLite kosong
RUN touch database/database.sqlite

# Generate app key
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod 664 /var/www/html/database/database.sqlite

# ============================================================
# Konfigurasi Nginx
# ============================================================
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf

# ============================================================
# Konfigurasi Supervisor (Nginx + PHP-FPM berjalan bersamaan)
# ============================================================
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Script entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Railway menggunakan PORT env variable (default 8080)
EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
