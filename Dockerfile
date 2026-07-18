FROM php:8.3-apache

# Install the PHP extensions used for MySQL.
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite rules if the project uses .htaccess.
RUN a2enmod rewrite

# Copy the application into Apache's public directory.
COPY . /var/www/html/

# Apply normal web-server ownership and permissions.
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80