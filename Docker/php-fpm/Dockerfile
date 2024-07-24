FROM phpdockerio/php:8.3-fpm
WORKDIR "/app"

# Instala pacotes necessários e extensões PHP
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        build-essential \
        git \
        nano \
        curl \
        xz-utils \
        php-pear \
        php8.3-dev \
        supervisor \
        php8.3-amqp \
        php8.3-bcmath \
        php8.3-bz2 \
        php8.3-cgi \
        php8.3-curl \
        php8.3-dba \
        php8.3-gd \
        php8.3-imap \
        php8.3-intl \
        php8.3-mysql \
        php8.3-oauth \
        php8.3-odbc \
        php8.3-redis \
        php8.3-snmp \
        php8.3-soap \
        php8.3-sqlite3 \
        php8.3-ssh2 \
#        php8.3-xdebug \
        php8.3-yaml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Instala Node.js (necessário para Yarn)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Instala Yarn
RUN npm install -g yarn

# Instala Xdebug (comentado por padrão)
# RUN pecl install xdebug
# COPY Docker/php-fpm/conf/xdebug.ini /etc/php/8.3/cli/conf.d/docker-php-ext-xdebug.ini
# COPY Docker/php-fpm/conf/uploads.ini /etc/php/8.3/cli/conf.d/docker-php-ext-uploads.ini
# COPY Docker/php-fpm/conf/php-ini-overrides.ini /etc/php/8.3/cli/conf.d/php-ini-overrides.ini
# COPY Docker/php-fpm/conf/xdebug.log /tmp/xdebug.log
# RUN chmod 777 /tmp/xdebug.log

COPY ../../project /app

RUN chown -R www-data:www-data /app

CMD composer install && yarn install && php-fpm8.3
