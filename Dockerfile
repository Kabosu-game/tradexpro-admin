FROM php:8.1-fpm

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Node.js 16.x
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first
COPY composer.json composer.lock ./

# Install dependencies without running scripts and autoloader
RUN composer install --no-scripts --no-autoloader --no-dev

# Copy the rest of the application
COPY --chown=www-data:www-data . .

# Create empty .env file to prevent errors during autoload
RUN touch .env

# Generate autoloader
RUN composer dump-autoload --optimize --no-dev --no-scripts

# Install and build frontend assets
RUN npm ci && npm run prod

# Clean up
RUN rm -rf /var/www/html/.npm /var/www/html/.composer/cache

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# Switch to non-root user
USER www-data

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
