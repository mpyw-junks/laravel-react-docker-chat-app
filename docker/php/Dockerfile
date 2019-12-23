FROM php:7.4-fpm-alpine

WORKDIR /code

RUN set -eux; \
  { \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    composer global require hirak/prestissimo; \
    composer config -g repos.packagist composer https://packagist.jp; \
  }

RUN set -eux; \
  { \
    apk add --update autoconf g++ libtool make; \
    pecl install redis; \
    docker-php-ext-install bcmath pdo_mysql; \
    docker-php-ext-enable redis; \
    rm -rf /tmp/* /var/cache/apk/*; \
  }

RUN set -eux; \
  { \
    cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini; \
    echo $'\n[date]\ndate.timezone = "Asia/Tokyo"' >> $PHP_INI_DIR/php.ini; \
  }

COPY composer.* /code/

RUN set -eux; \
  { \
    composer install --no-scripts --no-autoloader; \
  }

COPY . /code/

RUN set -eux; \
  { \
    composer dump-autoload -o; \
  }
