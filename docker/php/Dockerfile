FROM php:7.1-fpm
RUN set -x \
    && apt-get update \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        zlib1g-dev \
        libicu-dev \
        libcurl4-openssl-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
        curl \
        gd \
        intl \
        json \
        mbstring \
        opcache \
        pdo \
        pdo_mysql \
        zip \
    && pecl install xdebug \
    && rm -rf /tmp/pear \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get clean \
    && apt-get purge \
    && rm -rf /tmp/* /var/lib/apt/lists/*
