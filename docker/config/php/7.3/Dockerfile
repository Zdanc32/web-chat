FROM php:7.3-fpm
MAINTAINER globegroup

RUN apt-get update || apt-get update && apt-get install -y libssl-dev libxml2-dev zlib1g-dev libicu-dev libpq-dev libpng-dev libjpeg-dev libzip-dev curl git libcurl4-openssl-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql pgsql pdo_mysql \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache \
    && docker-php-ext-install ftp \
    && docker-php-ext-install soap

RUN pecl install -f raphf && docker-php-ext-enable raphf
RUN pecl install -f propro && docker-php-ext-enable propro
RUN pecl install -f pecl_http && docker-php-ext-enable http

RUN docker-php-ext-configure gd --with-gd --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) gd

RUN printf "\
    date.timezone=\"UTC\"\n\
    request_order=GP\n\
    expose_php=Off\n\
    enable_dl=Off\n\
    short_open_tag=Off\n\
    memory_limit = -1\n\
    upload_max_filesize = 2000M\n\
    post_max_size = 2000M\n\
    " > /usr/local/etc/php/php.ini

RUN pecl install -f xdebug

RUN  echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_output_dir=/tmp/xdebug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable_trigger=1" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-enable xdebug

RUN pecl install -f redis && docker-php-ext-enable redis
RUN pecl install -f mongodb && docker-php-ext-enable mongodb
# 21.05.19 usuwam bo pracujemy w UTC
# RUN echo "date.timezone = \"Europe/Warsaw\"" > /usr/local/etc/php/conf.d/datetime.ini

# Logs configuration
RUN  echo "catch_workers_output = yes" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_flag[display_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_value[error_log] = /var/log/fpm-php/fpm-php.www.log" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN mkdir /var/log/fpm-php && touch /var/log/fpm-php/fpm-php.www.log && chmod 777 /var/log/fpm-php/fpm-php.www.log

RUN usermod -u 1000 www-data

#COMPOSER
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN curl -L https://cs.symfony.com/download/php-cs-fixer-v2.phar -o php-cs-fixer \
    && chmod a+x php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer

RUN apt-get update && apt-get install -y nmap
