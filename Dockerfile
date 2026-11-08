# syntax=docker/dockerfile:1

# Install PHP dependencies in a disposable stage so the runtime image only
# carries the application and its production vendor directory.
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

# The runtime stage installs the extensions Laravel actually needs. Ignoring
# platform requirements here keeps the dependency stage focused on Composer.
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader \
    --ignore-platform-reqs

COPY . .

RUN composer dump-autoload \
    --no-dev \
    --no-scripts \
    --optimize \
    --no-interaction \
    --ignore-platform-reqs

FROM dunglas/frankenphp:php8.3 AS runtime

# PostgreSQL for Supabase, plus the extensions the framework and admin forms
# rely on. pdo_mysql is intentionally absent: the database config only needs
# the driver matching the deployed connection.
RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    opcache \
    bcmath

WORKDIR /app

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

COPY --from=vendor /app/vendor ./vendor
COPY . .

COPY docker/Caddyfile /etc/frankenphp/Caddyfile
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && mkdir -p \
        bootstrap/cache \
        storage/app/public \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
    && (php artisan storage:link || true)

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
