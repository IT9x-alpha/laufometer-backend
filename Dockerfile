ARG ENV=develop
FROM php:7.4-fpm-alpine
WORKDIR /app

RUN apk add --no-cache --virtual .build-deps curl-dev imagemagick-dev libtool libxml2-dev sqlite-dev autoconf gcc make g++ zlib-dev libpng-dev
RUN apk add --no-cache curl imagemagick libzip-dev libintl icu icu-dev oniguruma-dev git openssh-client bash
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN docker-php-ext-install exif bcmath curl iconv mbstring pdo pdo_mysql pcntl tokenizer xml zip intl gd
RUN pecl install redis && docker-php-ext-enable redis

# Composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Other
RUN apk del -f .build-deps
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install --prefer-dist --no-scripts --no-autoloader && rm -rf /root/.composer
COPY --chown=www-data:www-data . /app/
RUN composer install
