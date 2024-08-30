# docker/Dockerfile

# Use the official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy php.ini
COPY ./docker/php.ini /usr/local/etc/php/


# Copy the public and src directories to the container
# Copy Apache configuration
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY ./public .
COPY ./src .
# Set appropriate permissions for Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
