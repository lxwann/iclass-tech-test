# Use the official PHP image
FROM php:7.4-apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Copy the PHP script and other resources to the container
COPY index.php /var/www/html/index.php
COPY style.css /var/www/html/style.css
COPY script.js /var/www/html/script.js

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
