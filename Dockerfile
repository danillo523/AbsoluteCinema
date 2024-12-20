FROM php:8.4

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    supervisor \
    cron \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
RUN chmod -R 755 /var/www/html

RUN composer install

# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY .docker/crontab /etc/cron.d/laravel-cron

RUN chmod 0644 /etc/cron.d/laravel-cron
RUN crontab /etc/cron.d/laravel-cron

EXPOSE 8000

CMD ["/usr/bin/supervisord"]
