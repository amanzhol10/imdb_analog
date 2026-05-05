FROM php:8.4-fpm

RUN cp .env.example .env && \
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env && \
    sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=127.0.0.1/' .env && \
    APP_KEY=base64:$(openssl rand -base64 32) sed -i "s/APP_KEY=/APP_KEY=base64:$(openssl rand -base64 32)/" .env

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

RUN cp .env.example .env && \
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env && \
    php artisan key:generate --no-interaction
RUN chown -R www-data:www-data storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 9000

CMD ["/bin/bash", "-c", "php artisan config:clear && php artisan cache:clear && php artisan migrate --force && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf"]