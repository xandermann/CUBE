FROM composer:latest

RUN docker-php-ext-install pdo pdo_pgsql pgsql
