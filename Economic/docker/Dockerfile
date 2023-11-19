# FROM php:8.1.5-fpm-alpine

# RUN apk update && apk upgrade

# RUN apk add --no-cache zip unzip curl sqlite nginx supervisor

# RUN apk add bash

# RUN apk add --no-cache mysql-client

# RUN docker-php-ext-install pdo_mysql

# RUN rm -rf /var/lib/apt

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# RUN apk update

# RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
#     && pecl install xdebug-3.1.5 \
#     && docker-php-ext-enable xdebug \
#     && apk del -f .build-deps

FROM ubuntu:23.04

RUN apt-get update
RUN apt-get install -y software-properties-common
RUN add-apt-repository -y ppa:ondrej/php
RUN apt-get install -y php8.1-fpm
RUN apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath

RUN apt-get install -y curl
RUN apt-get install -y php-cli unzip

RUN apt-get install -y nodejs
# RUN apt-get install -y npm

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
# RUN apt-get install -y default-mysql-client

RUN apt-get install -y php-xdebug
RUN apt-get install -y php-codecoverage
RUN apt-get install -y curl
RUN curl -sL https://deb.nodesource.com/setup_19.x

RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
