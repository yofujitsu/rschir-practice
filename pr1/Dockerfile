FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
WORKDIR /var/www/html

COPY ./index.php /var/www/html/
COPY ./style.css /var/www/html/
COPY init.sql /docker-entrypoint-initdb.d/init.sql

EXPOSE 80
