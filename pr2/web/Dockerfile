FROM php:7.4-apache

# Установка зависимостей и настройка PHP и Apache
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

# Копирование файлов веб-приложения
COPY . /var/www/html/

# Настройка виртуального хоста Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
