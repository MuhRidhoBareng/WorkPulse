FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first (better caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy package files and build assets
COPY package.json package-lock.json ./
RUN npm ci

# Copy entire project
COPY . .

# Re-run composer scripts (autoload dump, package discover)
RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi

# Build Vite assets
RUN npm run build

# Cache config/routes/views for production
RUN php artisan config:clear \
    && php artisan route:cache \
    && php artisan view:cache

# Create storage link & set permissions
RUN php artisan storage:link || true
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE ${PORT:-8080}

# Start server
CMD php artisan migrate --force && php -S 0.0.0.0:${PORT:-8080} -t public
