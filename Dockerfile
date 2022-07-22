FROM php:7.4-apache
RUN \
    docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install pdo_mysql 
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apt-get update
RUN apt-get install sudo
RUN apt-get update
RUN apt-get install nano
RUN apt-get update
RUN sudo apt-get install bash-completion
RUN ln -s ../mods-available/{expires,headers,rewrite}.load /etc/apache2/mods-enabled/
RUN sed -e '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' -i /etc/apache2/apache2.conf
RUN sudo a2enmod rewrite