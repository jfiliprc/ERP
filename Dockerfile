FROM php:8.1-apache

# Copia seu apache.conf para substituir a config default do Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Ativa mod_rewrite (útil para MVC)
RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql



