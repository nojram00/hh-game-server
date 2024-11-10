FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libpq-dev && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global --add safe.directory /var/www/html

COPY . .

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# RUN composer update

RUN composer install

ENV DB_CONNECTION=pgsql \
    DB_HOST='ep-aged-glitter-a5b569fg.us-east-2.aws.neon.tech' \
    DB_PORT='5432' \
    DB_DATABASE='new_gameserver_db' \
    DB_USERNAME='mydb_owner' \
    DB_PASSWORD='oWhVc1x6zLOD' \
    APP_ENV=production \
    APP_DEBUG=false

RUN php artisan migrate || echo "migration failed"

EXPOSE 8000

ENTRYPOINT [ "php", "artisan" ]

CMD [ "serve", "--host=0.0.0.0", "--port=8000" ]
