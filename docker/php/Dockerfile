FROM php:8.0.5-fpm-alpine

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk update && apk add \
	mc \
	nano \
    build-base \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    vim \
    unzip \
    git \
    oniguruma-dev \
    curl \
    libpng-dev \
    libpng-dev \
    libmcrypt-dev

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd

# Install Redis Extension
RUN apk add autoconf && pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis && apk del autoconf

# Install xDebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer