FROM php:8.5-apache

RUN apt-get update && \
    apt-get install -y unzip git curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

# PHP upload and POST size limits for video uploads
RUN echo 'upload_max_filesize = 5G' > /usr/local/etc/php/conf.d/uploads.ini && \
    echo 'post_max_size = 5G' >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo 'max_execution_time = 300' >> /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .
RUN composer dump-autoload --optimize

EXPOSE 80
CMD ["apache2-foreground"]
