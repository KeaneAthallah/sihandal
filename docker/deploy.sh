#!/bin/bash
set -e

echo "=== Deploying Sihandal ==="

if [ ! -f .env ]; then
    echo "Generating APP_KEY and creating .env from .env.docker..."
    cp .env.docker .env
    docker compose run --rm app php artisan key:generate
fi

export $(grep -v '^#' .env | xargs)

echo "Building and starting containers..."
docker compose up -d --build

echo "Running migrations..."
docker compose exec app php artisan migrate --force

echo "Setting permissions..."
docker compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "=== Deploy complete! ==="
echo "Site: https://sihandal.online"
