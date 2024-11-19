# Usa una imagen base oficial de PHP con Apache
FROM php:8.1-apache

# Copia todos los archivos de tu proyecto al contenedor
COPY . /var/www/html/

# Cambia el dueño de los archivos para que Apache pueda acceder
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 (usado por Apache)
EXPOSE 80

# Instalar extensiones necesarias de PHP (ejemplo: mysqli)
RUN docker-php-ext-install mysqli