FROM php:8.2-apache

# Включаем mod_rewrite
RUN a2enmod rewrite

# Установка нужных пакетов и расширений PHP
RUN apt-get update && apt-get install -y unzip git libonig-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libxml2-dev default-mysql-client \
    && docker-php-ext-install mysqli pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Копируем composer файлы
WORKDIR /var/www
COPY composer.json composer.lock ./

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем зависимости Composer
RUN composer install --no-dev --optimize-autoloader

# Копируем весь проект
COPY . .

# Настраиваем папку public как корень сайта
RUN rm -rf /var/www/html \
    && ln -s /var/www/public /var/www/html \
    && chown -R www-data:www-data /var/www

RUN docker-php-ext-install pdo pdo_pgsql

EXPOSE 80
