FROM php:8.3-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Remove every enabled MPM, then enable only prefork.
RUN rm -f /etc/apache2/mods-enabled/mpm_event.load \
          /etc/apache2/mods-enabled/mpm_event.conf \
          /etc/apache2/mods-enabled/mpm_worker.load \
          /etc/apache2/mods-enabled/mpm_worker.conf \
          /etc/apache2/mods-enabled/mpm_prefork.load \
          /etc/apache2/mods-enabled/mpm_prefork.conf \
    && a2enmod mpm_prefork rewrite \
    && apache2ctl -M | grep mpm

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80