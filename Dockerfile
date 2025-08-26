FROM php:8.2-fpm

# Instala extensiones necesarias para Laravel
RUN apt-get update \
    && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

WORKDIR /var/www/html

# Copia los archivos del proyecto (opcional, ya que se usará volumen)
# COPY . /var/www/html

CMD ["php-fpm"]
