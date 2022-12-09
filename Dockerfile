FROM php:8.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

EXPOSE 80
WORKDIR /app

# git, unzip & zip are for composer
RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    gnupg \
    unzip \
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP Extensions
COPY conf/php.ini /usr/local/etc/php/conf.d/app.ini
RUN docker-php-ext-install pdo_pgsql openssl xml

# Apache
COPY errors /errors
COPY conf/apache.conf /etc/apache2/conf-available/z-app.conf
COPY * /app/

RUN a2enmod rewrite remoteip && \
    a2enconf z-src \
