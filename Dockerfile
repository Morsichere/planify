# Usa una imagen base oficial de PHP con Apache
FROM php:8.1-apache

# Establece el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# Copia todos los archivos de tu proyecto al directorio de trabajo
COPY . .

# Cambia el dueño de los archivos para que Apache pueda acceder
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instala extensiones necesarias de PHP (ejemplo: mysqli)
RUN docker-php-ext-install mysqli

# Exponer el puerto 80 (usado por Apache)
EXPOSE 80
