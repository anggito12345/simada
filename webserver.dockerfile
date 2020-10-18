FROM nginx:latest

ADD ./docker-config/laravelVHost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www

COPY ./docker-config/php.ini /usr/local/etc/php.ini
