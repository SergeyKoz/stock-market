FROM php:fpm-alpine

RUN apk add --no-cache \
		$PHPIZE_DEPS \
		openssl-dev

RUN apk add mysql-client \
    && pecl install xdebug \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli \
    && docker-php-ext-configure mysqli --with-mysql-sock=/var/run/mysqld/mysqld.sock \
    && docker-php-ext-enable xdebug

# COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /opt
# CMD composer install ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm
CMD php-fpm
EXPOSE 900
