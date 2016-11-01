FROM php:7.0.5-alpine

RUN apk update \
    && apk add zlib-dev \
    && docker-php-ext-install zip curl openssl mbstring tokenizer \
    && apk add libpq
    
# add app user
RUN adduser -D -u 1000 appuser \
    && addgroup appuser www-data \
    && addgroup www-data appuser

# add xdebug
RUN apk add --update wget ca-certificates autoconf gcc g++ binutils make \
    && wget http://xdebug.org/files/xdebug-2.4.0.tgz \
    && tar -xvzf xdebug-2.4.0.tgz \
    && rm -f xdebug-2.4.0.tgz \
    && cd xdebug-2.4.0 \
    && phpize \
    && ./configure \
    && make \
    && cp modules/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20151012 \
    && echo 'zend_extension = /usr/local/lib/php/extensions/no-debug-non-zts-20151012/xdebug.so' > /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_enable=on' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_host=localhost' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_handler=dbgp' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.profiler_enable=0' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_log=/app/log/xdebug_remote.log' >> /usr/local/etc/php/php.ini \
    # это нужно для того чтобы в рантайме переопределять xdebug.remote_host
    && chown appuser:appuser /usr/local/etc/php/php.ini \
    && apk del wget ca-certificates autoconf gcc g++ binutils make

# add phpunit
RUN wget https://phar.phpunit.de/phpunit.phar \
    && chmod +x phpunit.phar \
    && mv phpunit.phar /usr/local/bin/phpunit

COPY ./run.sh /app/
RUN chmod +x /app/run.sh

USER 1000

WORKDIR /app/htdocs

CMD ["/app/run.sh"]
