FROM php:8.2-apache

# Включаем mod_rewrite
RUN a2enmod rewrite

# Установка нужных пакетов
RUN apt-get update && apt-get install -y unzip git

# Установка composer
COPY composer.json composer.lock /var/www/
WORKDIR /var/www
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Копируем весь проект
COPY . /var/www

# Заменяем Apache-папку на public/
RUN rm -rf /var/www/html
RUN ln -s /var/www/public /var/www/html

RUN chown -R www-data:www-data /var/www

EXPOSE 80
