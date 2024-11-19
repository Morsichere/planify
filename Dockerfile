# Usa una imagen base oficial de PHP con Apache
FROM php:8.1-apache

# Establece el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# Copia los archivos del subdirectorio "index" al directorio raíz de Apache
COPY index/ /var/www/html/
# Copia la carpeta CSS al directorio raíz de Apache
COPY CSS/ /var/www/html/CSS/
COPY media/ /var/www/html/media/
# Cambia el propietario y los permisos de los archivos para que Apache pueda acceder
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configura el ServerName para evitar advertencias de Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configura el archivo predeterminado de índice (index.html o index.php)
RUN echo "DirectoryIndex index.html index.php" >> /etc/apache2/apache2.conf

# Instala extensiones necesarias de PHP (ejemplo: mysqli)
RUN docker-php-ext-install mysqli

# Exponer el puerto 80 (usado por Apache)
EXPOSE 80
