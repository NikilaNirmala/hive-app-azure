# Use official PHP image with PHP 8.2 and FPM
FROM php:8.2-fpm

# Install necessary system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip git unzip libxml2-dev \
    libssl-dev libcurl4-openssl-dev pkg-config \
    nodejs npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install MongoDB extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install PHP extensions required for Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory to /var/www/html
WORKDIR /var/www/html

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --prefer-dist

# Copy the rest of the Laravel project files
COPY . .

# Set correct file permissions for Laravel
RUN chmod -R 755 /var/www/html \
    && chmod +x /var/www/html/artisan

# Install Node.js dependencies (for assets, Vite, etc.)
RUN npm install

# Build assets using Vite (optional depending on your Laravel setup)
RUN npm run dev

# Expose ports for PHP-FPM and the app
EXPOSE 9000

# Expose additional ports for services like queue workers or API (if needed)
EXPOSE 8080

# Command to run the PHP-FPM server
CMD ["php-fpm"]
