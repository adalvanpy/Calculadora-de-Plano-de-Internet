FROM php:8.2-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html
COPY . /var/www/html

RUN composer require phpmailer/phpmailer


