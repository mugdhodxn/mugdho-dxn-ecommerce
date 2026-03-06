#!/bin/bash

echo "Starting Mugdho DXN deployment..."

# Create necessary directories
echo "Creating storage directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
mkdir -p bootstrap/cache
mkdir -p storage/app/public

# Set permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

# Check if APP_KEY is set
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set!"
    echo "Please generate one with: php artisan key:generate --show"
    exit 1
fi

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Seed database if needed
if [ "$SEED_DATABASE" = "true" ]; then
    echo "Seeding database..."
    php artisan db:seed --force
fi

# Create storage link
echo "Creating storage link..."
php artisan storage:link || true

# Clear and cache config
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
echo "Starting server on port ${PORT:-8000}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
