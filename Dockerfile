FROM php:fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
WORKDIR /code
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install npm -y
# RUN chmod -R 777 storage/ 
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"] 