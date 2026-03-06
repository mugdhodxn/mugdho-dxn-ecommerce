#!/bin/bash

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
php artisan migrate --force

# Seed database (only if empty)
php artisan db:seed --force

# Create storage link
php artisan storage:link

# Start server
php artisan serve --host=0.0.0.0 --port=$PORT
