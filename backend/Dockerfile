# Estágio Base: instala dependências comuns
FROM php:8.2-fpm AS base
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip netcat-openbsd
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www

# Estágio de Desenvolvimento
FROM base AS dev
CMD ["php-fpm"]


# Estágio de Produção (ADAPTADO)
FROM base AS prod
COPY . .
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
CMD ["php-fpm"]