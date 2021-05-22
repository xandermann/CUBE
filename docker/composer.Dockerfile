FROM composer:2.0.13

RUN apk add libpq postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY docker/wait-for-it.sh /bin/
