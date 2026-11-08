#!/bin/sh
set -e

# Render's filesystem is ephemeral, so the public storage link and the demo
# data are recreated on every boot. Both operations are idempotent.
php artisan storage:link --force >/dev/null 2>&1 || true

php artisan migrate --force
php artisan db:seed --force
php artisan package:discover --ansi
php artisan optimize

exec frankenphp run --config /etc/frankenphp/Caddyfile
