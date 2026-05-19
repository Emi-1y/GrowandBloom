FROM php:8.3.11-apache
RUN apt-get update -y && apt-get install -y openssl zip unzip git 
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html
COPY ./public/.htaccess /var/www/html/.htaccess
WORKDIR /var/www/html
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

RUN php artisan key:generate
RUN php artisan migrate
RUN chmod -R 777 storage
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|</VirtualHost>|<Directory /var/www/html/public>\n\tAllowOverride All\n\tRequire all granted\n</Directory>\n</VirtualHost>|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN service apache2 restart
