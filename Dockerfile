# Usamos una imagen de PHP con Apache
FROM php:8.2-apache

# 1. Instalamos extensiones de sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# 2. Habilitamos mod_rewrite de Apache (crucial para las rutas de Laravel)
RUN a2enmod rewrite

# 3. Cambiamos el DocumentRoot a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copiamos el código del proyecto
WORKDIR /var/www/html
COPY . .

# 6. Instalamos dependencias de PHP y damos permisos
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Puerto que expone Render por defecto
EXPOSE 80

# Script de inicio para limpiar caché y levantar Apache
CMD ["apache2-foreground"]