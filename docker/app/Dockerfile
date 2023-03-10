FROM php:8.0-fpm as base

# Use bash instead of sh
SHELL ["/bin/bash", "-c"]

RUN docker-php-ext-install opcache

RUN apt update && apt install -y git zip

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
