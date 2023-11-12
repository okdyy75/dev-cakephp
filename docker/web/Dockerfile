FROM composer:2 as composer2

FROM php:8.1-apache

COPY ./apache2.conf /etc/apache2/apache2.conf

RUN rm -rf \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/sites-available/default-ssl.conf

COPY ./sites-available/localhost.conf /etc/apache2/sites-available/localhost.conf

RUN unlink /etc/apache2/sites-enabled/000-default.conf

RUN ln -s ../sites-available/localhost.conf /etc/apache2/sites-enabled/localhost.conf

RUN apt-get update

RUN apt-get install -y unzip libicu-dev

RUN docker-php-ext-install intl pdo_mysql

RUN a2enmod rewrite

COPY --from=composer2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["apache2-foreground"]
