#!/bin/sh

set -e

if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.docker /var/www/html/.env
    echo ".env file created from .env.docker"
fi

php artisan storage:link --force 2>/dev/null || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan migrate --force --isolated

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
