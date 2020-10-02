FROM php:7.2-fpm-alpine

RUN apk add --update \
    git \
    libpng-dev \
    libmcrypt-dev \
    postgresql-dev \
    zip

RUN docker-php-ext-install pdo pdo_pgsql
