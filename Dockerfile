# ----- build frotend assets -----
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build


# ---install php deps ---
FROM composer:2 AS vendor
WORKDIR /app
COPY database/ database/
COPY composer.json composer-lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader


# --- Stage 3: final runtime image ---
FROM php:8.5-cli-alpine

RUN apk add --no-cache \
    libzip-dev zip unzip icu-dev oniguruma-dev \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql mbstring zip intl gd bcmath

WORKDIR /var/www/html

COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080
ENTRYPOINT ["/entrypoint.sh"]