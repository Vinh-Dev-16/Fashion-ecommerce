FROM omtvn/php81
RUN docker-php-ext-install pcntl

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer
WORKDIR /var/www/html/
#
COPY ./ /var/www/html/
#
#RUN composer update --no-scripts
RUN chown -R nginx:nginx /var/www/html/storage
##RUN chmod 777 /usr/share/nginx/html/
RUN chmod -R 777 /var/www/html/storage
RUN mkdir -p /var/lib/nginx/tmp  && chmod -R 755 /var/lib/nginx /var/log/nginx
CMD ["/start.sh"]