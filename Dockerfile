FROM php:8.1-fpm

ENV PHP_OPCACHE_ENABLE=1
ENV NODE_ENV=production
ENV HOME=/var/www/html

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
    && rm -rf /var/lib/apt/lists/* \
    && npm install -g cross-env

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy package files first
COPY package*.json ./
COPY composer.json composer.lock ./

# Set correct permissions early
RUN mkdir -p /var/www/html/.npm \
    && chown -R www-data:www-data /var/www/html

# Switch to www-data user for package installations
USER www-data

# Install npm dependencies and fix vulnerabilities
RUN npm ci \
    && npm audit fix --force || true

# Install PHP dependencies
RUN composer install --no-scripts --no-autoloader --no-dev

# Copy the rest of the application
USER root
COPY . .
RUN chown -R www-data:www-data /var/www/html
USER www-data

# Create empty .env file to prevent errors during autoload
RUN touch .env

# Generate autoloader
RUN composer dump-autoload --optimize --no-dev --no-scripts

# Build frontend assets
RUN npm run prod

# Clean up
RUN rm -rf .npm

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
