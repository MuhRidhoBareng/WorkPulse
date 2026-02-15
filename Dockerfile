FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first (better caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy package files and install node dependencies
COPY package.json package-lock.json vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources
RUN npm ci

# Copy entire project
COPY . .

# Re-run composer scripts (autoload dump, package discover)
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi

# Build Vite assets for production
RUN npm run build

# Verify build output exists
RUN ls -la public/build/ && echo "✅ Vite build successful"

# Cache views for production
RUN php artisan view:cache

# Create storage directories & set permissions
RUN mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache/data \
    && mkdir -p storage/logs \
    && chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE ${PORT:-8080}

# Start: run migrations, create storage link, then serve
CMD php artisan migrate --force \
    && php artisan storage:link \
    && php artisan config:clear \
    && php artisan route:cache \
    && echo "🚀 Starting WorkPulse on port ${PORT:-8080}" \
    && php -S 0.0.0.0:${PORT:-8080} -t public
