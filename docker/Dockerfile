FROM php:8.2-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY ./docker/php.ini /usr/local/etc/php/

COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY ./public .
COPY ./src .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
