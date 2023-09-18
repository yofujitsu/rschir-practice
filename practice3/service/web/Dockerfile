FROM php:7.4-apache

RUN apt-get update && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

EXPOSE 80