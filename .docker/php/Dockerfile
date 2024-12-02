# Use official PHP image with FPM
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy the application contents into the container
COPY . /var/www

# Set proper permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Install dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port for PHP-FPM (usually 9000 for PHP-FPM)
EXPOSE 8000

# Command to run Laravel's built-in PHP server on port 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]