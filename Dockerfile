FROM php:8.2-apache

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libzip-dev \
    zip \
    git \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Copier tous les fichiers du projet
COPY . /var/www/html

# Définir le bon répertoire de travail
WORKDIR /var/www/html

# Installer automatiquement les dépendances PHP via Composer
RUN composer install --no-interaction --no-suggest --prefer-dist

# Donner les bons droits à Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
