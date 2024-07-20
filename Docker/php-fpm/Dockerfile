FROM php:8.1.0-fpm-alpine

RUN apk --update --no-cache add git

RUN apk add bash

RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        freetype-dev \
        zip \
        libxml2-dev \
        libzip-dev \
        yarn \
        p7zip

RUN set -eux; \
    apk update; \
    apk add libxml2-dev; \
    apk add php8-soap;

RUN docker-php-ext-install soap
RUN docker-php-ext-enable soap

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd

RUN docker-php-ext-install zip xml

RUN apk add icu-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-configure intl && docker-php-ext-install intl

RUN apk add --update linux-headers

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

COPY Docker/php-fpm/conf/xdebug.ini /usr/local/etc/php/conf.d/docker-php1-ext-xdebug.ini
COPY Docker/php-fpm/conf/uploads.ini /usr/local/etc/php/conf.d/docker-php1-ext-uploads.ini

COPY Docker/php-fpm/conf/xdebug.log /tmp/xdebug.log

RUN chmod 777 /tmp/xdebug.log

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY ./project/ /var/www/html
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

EXPOSE 9000

CMD composer install; yarn run build ; php-fpm
# CMD ["sh", "-c", "composer install --no-interaction --prefer-dist --optimize-autoloader && yarn run build && php-fpm"]