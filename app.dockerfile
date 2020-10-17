FROM php:7.2-fpm

RUN apt-get update 2>/dev/null | grep packages | cut -d '.' -f 1 && apt-get install -y libpq-dev libmcrypt-dev vim libfreetype6-dev libjpeg62-turbo-dev libpng-dev  && apt clean
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/


WORKDIR /var/www

COPY .env.docker .env

CMD php artisan migrate:fresh --seed

EXPOSE 8070
