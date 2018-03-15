FROM php:7.1-cli
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update -yqq \
    && apt-get install git zlib1g-dev libsqlite3-dev -y \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo_sqlite

RUN curl -fsSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

ENV PATH /root/.composer/vendor/bin:$PATH

WORKDIR /app
CMD [ "php", "./index.php" ]
