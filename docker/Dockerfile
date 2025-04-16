FROM php:8.3-apache

COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

RUN apt update && apt install -y curl git vim zip
RUN sed -i -e "s#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#" /etc/apache2/sites-enabled/000-default.conf

RUN apt install -y libzip-dev
RUN docker-php-ext-install zip

WORKDIR /var/www/html