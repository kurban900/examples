FROM php:8-fpm

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

RUN apt-get update && apt-get install -y libpq-dev unzip \
    && docker-php-ext-install pdo_mysql mysqli

WORKDIR /app

COPY ./ ./
