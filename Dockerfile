FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js 20 via NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy everything
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies & build Vite assets
RUN npm ci && npm run build

# Verify Vite build output
RUN ls -la public/build/manifest.json && echo "Vite build OK"

# Create storage directories & set permissions
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache/data \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create startup script
# IMPORTANT: config:cache and route:cache run at STARTUP (not build time)
# because Railway env vars are only available at runtime
RUN echo '#!/bin/bash\n\
    set -e\n\
    echo "Running migrations..."\n\
    php artisan migrate --force\n\
    echo "Creating storage link..."\n\
    php artisan storage:link 2>/dev/null || true\n\
    echo "Caching config..."\n\
    php artisan config:cache\n\
    echo "Caching routes..."\n\
    php artisan route:cache\n\
    echo "Caching views..."\n\
    php artisan view:cache\n\
    echo "Starting server on port ${PORT:-8080}..."\n\
    php -S 0.0.0.0:${PORT:-8080} -t public\n\
    ' > /app/start.sh && chmod +x /app/start.sh

EXPOSE ${PORT:-8080}

CMD ["/bin/bash", "/app/start.sh"]
