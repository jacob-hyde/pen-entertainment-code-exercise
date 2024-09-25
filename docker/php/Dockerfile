# Dockerfile
FROM php:8.3-fpm

# Install PDO and PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Copy the application to the container
COPY ./app /var/www/html
