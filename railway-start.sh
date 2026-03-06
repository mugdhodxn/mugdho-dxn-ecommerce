#!/bin/bash

echo "=== Mugdho DXN Deployment Started ==="

# Create necessary directories
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
mkdir -p bootstrap/cache
mkdir -p storage/app/public

# Set permissions
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Check if APP_KEY is set
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set!"
    exit 1
fi

echo "APP_KEY is set: ${APP_KEY:0:20}..."

# Check database variables
echo "Checking database connection..."
echo "DB_HOST: ${DB_HOST}"
echo "DB_DATABASE: ${DB_DATABASE}"
echo "DB_USERNAME: ${DB_USERNAME}"

# Wait for database to be ready
echo "Waiting for database..."
sleep 5

# Run migrations
echo "Running database migrations..."
php artisan migrate --force 2>&1 || {
    echo "Migration failed, but continuing..."
}

# Seed database if needed
if [ "$SEED_DATABASE" = "true" ]; then
    echo "Seeding database..."
    php artisan db:seed --force 2>&1 || echo "Seeding skipped"
fi

# Create storage link
php artisan storage:link 2>/dev/null || true

# Clear all caches
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

echo "=== Starting server on port ${PORT:-8000} ==="
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
