FROM php:fpm-alpine

WORKDIR /opt

RUN apk add --no-cache \
		$PHPIZE_DEPS \
		openssl-dev

RUN apk add mysql-client \
    && pecl install xdebug \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli \
    && docker-php-ext-configure mysqli --with-mysql-sock=/var/run/mysqld/mysqld.sock \
    && docker-php-ext-enable xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

CMD php-fpm
EXPOSE 900
