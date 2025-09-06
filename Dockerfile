FROM php:8.2-apache

# Installer les extensions PHP nécessaires à Symfony (MySQL + intl + zip + opcache)
RUN apt-get update && apt-get install -y \
    git zip unzip libicu-dev libonig-dev libzip-dev libpng-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache gd

# Installer et activer MongoDB (car ArcadiaZoo utilise MongoDB pour les "J'aime")
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Activer mod_rewrite pour Symfony
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet dans le conteneur
COPY . .

# Donner les bons droits à Apache
RUN chown -R www-data:www-data /var/www/html

# Définir le dossier public comme racine Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Installer Composer (pour gérer les dépendances Symfony)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist

# Exposer le port 80
EXPOSE 80
