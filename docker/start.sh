#!/bin/bash
set -e

echo "=== WorkPulse Startup ==="

echo "Running migrations..."
php artisan migrate --force

echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Starting server on port ${PORT:-8080}..."
php -S 0.0.0.0:${PORT:-8080} -t public server.php
