FROM php:8.0-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y libpng-dev zip unzip

RUN docker-php-ext-install pdo pdo_mysql gd

COPY . /var/www

RUN composer install

CMD ["php-fpm"]

EXPOSE 9000
