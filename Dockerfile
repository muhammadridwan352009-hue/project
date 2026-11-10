# ============================================================
# SIMPATI - Dockerfile untuk Fly.io
# Laravel 12 + PHP 8.2 + SQLite + Nginx
# ============================================================

FROM php:8.2-fpm-alpine AS base

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

# Salin composer files dulu (untuk cache layer)
COPY composer.json composer.lock ./

# Install PHP dependencies (tanpa dev)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Salin package.json untuk npm
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts

# Salin semua file aplikasi
COPY . .

# Build assets Vite (CSS/JS)
RUN npm run build

# Jalankan composer autoload dan scripts
RUN composer dump-autoload --optimize --no-dev

# Buat direktori yang diperlukan
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    database

# Salin .env.example sebagai .env (env asli akan di-set via Fly secrets)
RUN cp .env.example .env || true

# Buat file SQLite (akan diganti oleh volume di Fly.io)
RUN touch database/database.sqlite

# Generate app key
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod 664 /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite

# ============================================================
# Konfigurasi Nginx
# ============================================================
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/http.d/default.conf

# ============================================================
# Konfigurasi Supervisor (menjalankan Nginx + PHP-FPM)
# ============================================================
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Script entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
