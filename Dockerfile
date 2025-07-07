FROM php:8.2-apache

RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html/

WORKDIR /var/www/html
