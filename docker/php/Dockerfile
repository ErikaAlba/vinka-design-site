FROM php:8.1-fpm-alpine

RUN mkdir /.composer/ \
    && chown -R www-data:www-data /.composer \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

ENV PATH /var/www/html/bin:/var/www/html/vendor/bin:$PATH

WORKDIR /var/www/html