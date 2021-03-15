FROM php:7.2-apache


RUN apt-get update \
    && apt-get install -y zlib1g-dev mariadb-client libpng-dev libjpeg-dev gnupg curl wget \
    # && mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled \
    && docker-php-ext-configure gd --with-png-dir=/usr/include --with-jpeg-dir=/usr/include \
    && docker-php-ext-install zip pdo_mysql gd

COPY 000-default.conf /etc/apache2/sites-enabled/
RUN a2enmod rewrite

# composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '$(wget -q -O - https://composer.github.io/installer.sig)') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/html
