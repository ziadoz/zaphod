FROM php:8-fpm

# Set environment variables
ENV DEBIAN_FRONTEND noninteractive

# Install PHP extensions
RUN echo "Upgrading" \
    && apt-get update \
    && apt-get upgrade -yqq \

    && echo "Installing cURL" \
    && apt-get install -yqq libssl-dev libcurl4-openssl-dev curl \
    && docker-php-ext-install curl \

    && echo "Installing GD" \
    && apt-get install -yqq libjpeg-dev libpng-dev libfreetype6-dev libwebp-dev libxpm-dev \
    && docker-php-ext-configure gd \
        --prefix=/usr --with-jpeg \
        --with-webp \
        --with-xpm \
        --with-freetype \
    && docker-php-ext-install gd \

    && echo "Installing Imagick" \
    && apt-get install -yqq git libmagickwand-dev imagemagick \
    && cd /tmp \
    && git clone https://github.com/Imagick/imagick \
    && cd imagick \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && rm -r /tmp/imagick \
    && docker-php-ext-enable imagick \

    && echo "Installing IMAP" \
    && apt-get install -yqq libc-client-dev libkrb5-dev \
    && docker-php-ext-configure imap \
        --with-kerberos \
        --with-imap-ssl \
    && docker-php-ext-install imap \

    && echo "Installing INTL" \
    && apt-get install -yqq zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \

    && echo "Installing MBString" \
    && apt-get install -yqq libonig-dev \
    && docker-php-ext-install mbstring \

    && echo "Installing Zip" \
    && apt-get install -yqq libz-dev libzip-dev zip unzip \
    && docker-php-ext-install zip \

    && echo "Installing BCMath, Exif, JSON, Opcache, PCNTL, PDO MySQL" \
    && docker-php-ext-install \
        bcmath \
        exif \
        pcntl \
        pdo_mysql \

    && echo "Installing XDebug" \
    && pecl channel-update pecl.php.net \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \

    && echo "Configuring PHP" \
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \

    && echo "Cleaning Up" \
    && apt-get clean \
    && apt-get purge \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
# @see https://github.com/docker-library/docs/tree/master/composer#php-version--extensions
COPY --from=composer /usr/bin/composer /usr/bin/composer

## Install MariaDB client (MySQL 8 compatible, ARM64 version available)
RUN apt-get update \
    && apt-get install -yqq software-properties-common dirmngr gnupg2 \
    && apt-key adv --fetch-keys 'https://mariadb.org/mariadb_release_signing_key.asc' \
    && add-apt-repository 'deb https://mirrors.ukfast.co.uk/sites/mariadb/repo/10.5/debian buster main' \
    && apt-get update \
    && apt-get install -yqq mariadb-client \
    && ln -s /usr/bin/mariadb /usr/local/bin/mysql

## Install MySQL 8.0 client
## @todo: Once ARM64 version available uncomment this and remove MariaDB client above.
## RUN apt-get update \
##    && apt-get install -yqq gnupg2 \
##    && apt-key adv --keyserver pool.sks-keyservers.net --recv-keys 5072E1F5 \
##    && echo "deb http://repo.mysql.com/apt/debian buster mysql-8.0" | tee /etc/apt/sources.list.d/mysql80.list \
##    && apt-get update \
##    && apt-get install -yqq mysql-client

# Install Node and Yarn
# @see: https://github.com/nodesource/distributions
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get update \
    && apt-get install -yqq nodejs \
    && npm install --global yarn

# Copy Configuration
COPY xdebug.ini "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"