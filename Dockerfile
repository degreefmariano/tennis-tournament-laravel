# Usa una imagen base oficial de PHP
FROM php:8.2-fpm

# Instala las dependencias del sistema
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git libonig-dev libxml2-dev

# Instala las extensiones de PHP necesarias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd zip mysqli pdo pdo_mysql

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos de la aplicación al contenedor
COPY . .

# Instala las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN composer install

# Establece permisos de archivos
RUN chown -R www-data:www-data /var/www

# Expone el puerto 9000 para el contenedor
EXPOSE 9000

# Define el comando para ejecutar el contenedor
CMD ["php-fpm"]
