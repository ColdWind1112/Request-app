FROM php:8.0-apache
WORKDIR /var/www/html

RUN a2enmod rewrite

COPY src/ /var/www/html/
EXPOSE 80