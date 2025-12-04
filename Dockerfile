# PHP-FPM untuk Nginx
FROM php:8.2-fpm
# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Set working directory
WORKDIR /var/www/gym_memberships
# Set proper permissions
RUN chown -R www-data:www-data /var/www/gym_memberships
# Expose port 9000 untuk PHP-FPM
EXPOSE 9000