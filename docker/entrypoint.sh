#!/bin/sh
set -e

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

mkdir -p storage/framework/{sessions,views,cache/data} storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

# Si estamos en producción o APP_ENV lo requiere, cachear
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
else
    php artisan config:clear
fi

php artisan migrate --force

exec "$@"

