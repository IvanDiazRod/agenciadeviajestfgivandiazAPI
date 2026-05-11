# 1. Usamos PHP 8.4 para cumplir con Symfony 8 y Laravel 13
FROM php:8.4-apache

# 2. Instalamos las dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip xml dom mbstring bcmath

# 3. Habilitamos mod_rewrite de Apache
RUN a2enmod rewrite

# 4. Apuntamos el DocumentRoot a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 6. Copiamos archivos de dependencias
COPY composer.json composer.lock ./

# 7. Instalamos las dependencias (con PHP 8.4 ya no darán error)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 8. Copiamos el resto del código
COPY . .

# 9. Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage

EXPOSE 80

CMD ["apache2-foreground"]