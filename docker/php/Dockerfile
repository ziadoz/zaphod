FROM php:8-fpm

# Set environment variables
ENV DEBIAN_FRONTEND noninteractive

# Install PHP extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN apt-get update \
    && apt-get upgrade -yqq \
    && install-php-extensions \
        bcmath \
        curl \
        exif \
        gd \
        imap \
        intl \
        mbstring \
        pcntl \
        pdo_mysql \
        zip \
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

# Configure PHP and XDebug
COPY --from=php:8-fpm /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY xdebug.ini "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"
