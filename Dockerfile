# Step 1: Use PHP base image with FPM for Laravel
FROM php:8.2-fpm AS php-fpm

# Step 2.1: Install System Dependencies (Apt Packages)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    pkg-config \
    bison \
    re2c \
    git \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
# Cleanup is done immediately to minimize the layer size.

# Step 2.2: Configure and Install Core PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql xml intl bcmath ctype mbstring tokenizer

# Step 2.3: Install PECL Extensions (like MongoDB)
# PECL requires separate steps and often a channel update.
RUN pecl channel-update pecl.php.net \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Step 3: Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 4: Install Node.js for Vite
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Step 5: Set working directory
WORKDIR /var/www

# Step 6: Copy application files
COPY . /var/www

# Step 7: Install PHP dependencies
RUN composer config --global repo.packagist composer https://mirrors.aliyun.com/composer/ \
    && php -d memory_limit=-1 /usr/local/bin/composer install --optimize-autoloader --no-dev --prefer-dist

# Step 8: Install JavaScript dependencies
RUN npm install

# Step 9: Build frontend assets
RUN npm run build

# Step 10: Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Step 11: Expose PHP-FPM port
EXPOSE 9000

# Step 12: Expose app port (optional, as Nginx handles external traffic)
EXPOSE 8080

# Step 13: Run Laravel post-install scripts
RUN php artisan key:generate --ansi \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Step 14: Start PHP-FPM
CMD ["php-fpm"]
