FROM php:8.3-apache


COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

# Fail the build if Apache has an invalid configuration.
RUN apache2ctl configtest

CMD ["bash", "-lc", "a2dismod mpm_event mpm_worker || true; a2enmod mpm_prefork; exec apache2-foreground"]