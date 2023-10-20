FROM siomkin/8-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer
RUN apk add --no-cache git
RUN mkdir -p /application
WORKDIR var/www/html
COPY . /application
