# 1. Cambiamos a la imagen oficial de PHP 8.3
FROM php:8.3-apache

# 2. Instalamos dependencias del sistema y extensiones de PHP necesarias para Laravel 13 y DomPDF
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

# 3. Habilitamos el módulo rewrite de Apache
RUN a2enmod rewrite

# 4. Apuntamos Apache a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Instalamos Composer (Versión 2.x)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Directorio de trabajo
WORKDIR /var/www/html

# 7. Copiamos solo los archivos de dependencias primero
COPY composer.json composer.lock ./

# 8. Instalamos dependencias
# Usamos --no-scripts para evitar que intente ejecutar artisan antes de copiar el código
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 9. Ahora copiamos todo el código del proyecto
COPY . .

# 10. Permisos necesarios para el almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage

# 11. Puerto de Render
EXPOSE 80

# 12. Comando de inicio
CMD ["apache2-foreground"]