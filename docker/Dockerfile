FROM php:8.2-fpm

# Sistem bağımlılıkları
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    supervisor

# PHP uzantıları
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Redis PHP eklentisi
RUN pecl install redis \
    && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Kodu kopyala
COPY . .

# Composer install
RUN composer install --no-interaction --optimize-autoloader

# Storage & cache izinleri
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Supervisor yapılandırmasını kopyala
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Supervisor entrypoint
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
