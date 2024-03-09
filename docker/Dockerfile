FROM php:8.3-fpm

RUN apt update && apt-get update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libxslt1-dev\
    && docker-php-ext-install intl \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install xsl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-install opcache

RUN apt-get install -y libxml2-dev \
    && docker-php-ext-install soap

COPY --chown=www-data:www-data . /var/www/html

USER www-data

EXPOSE 9000
CMD ["php-fpm"]