FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl git nginx supervisor \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

RUN chown -R www-data:www-data storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/bin/bash", "-c", "envsubst '$PORT' < /etc/nginx/sites-available/default > /tmp/nginx.conf && cp /tmp/nginx.conf /etc/nginx/sites-available/default && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf"]