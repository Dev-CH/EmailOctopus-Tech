FROM php:8.2-fpm

SHELL ["/bin/bash", "-o", "pipefail", "-c"]

RUN apt-get update
RUN apt-get install -y --no-install-recommends libzip-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql zip
RUN docker-php-ext-enable mysqli


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/bin/composer

RUN echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/project.ini \
    && echo "max_execution_time=30" >> /usr/local/etc/php/conf.d/project.ini \
    && echo "max_input_vars=10000" >> /usr/local/etc/php/conf.d/project.ini
