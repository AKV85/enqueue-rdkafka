FROM php:7.4-fpm

WORKDIR /app

RUN apt-get update \
    && apt-get install -y librdkafka-dev git zip unzip wget \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    # composer
    && curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN apt-get update --fix-missing \
    && apt-get install -y curl wget zip unzip git \
    && rm -rf /var/lib/apt/lists/*

# DEPENDENCIES
RUN apt-get update --fix-missing \
    && apt-get install -y python \
    && rm -rf /var/lib/apt/lists/*

#KAFKA
RUN echo "extension rdkafka.so" > /usr/local/etc/php/conf.d/rdkafka.ini

RUN pecl channel-update pecl.php.net  \
    && pecl uninstall rdkafka \
    && pecl install rdkafka-4.1.2


