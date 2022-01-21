FROM php:8.0.0-fpm-alpine AS php
WORKDIR /app
RUN apk add -U --no-cache curl-dev
RUN docker-php-ext-install curl exif
RUN docker-php-source extract \
    && apk add --no-cache --virtual .phpize-deps-configure $PHPIZE_DEPS \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && apk del .phpize-deps-configure \
    && docker-php-source delete
RUN apk add libpng-dev
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql
RUN install -o www-data -g www-data -d /app/public/image
RUN echo -e "post_max_size = 5M\nupload_max_filesize = 5M" >> ${PHP_INI_DIR}/php.ini
RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer
RUN chown -R www-data:www-data /app/public/image
RUN chmod +x /app/public