FROM php:7.4-fpm-alpine

WORKDIR /var/www/web

RUN apk update && apk add --no-cache git curl g++ make autoconf \
    && docker-php-source extract \
    && docker-php-source delete


# RUN pecl install xdebug redis grpc \
#     && docker-php-ext-enable xdebug redis grpc
RUN pecl install redis-5.1.1 \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/* 


# COPY ./docker/php/php.ini /usr/local/etc/php/

EXPOSE 9000
EXPOSE 8000

VOLUME ["/var/www/web", "/var/log/php7"]