# Use the official PHP image as base edited by vaskya
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    zip \
    libzip-dev \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the existing application directory contents
COPY . /var/www/html

RUN rm -rf /etc/apache2/sites-available/000-default.conf

#Copy apache2 config
COPY docker/apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite 
RUN a2enmod rewrite

# Install application dependencies
RUN composer install

# Copy existing application directory permissions
COPY . /var/www/html

# Change ownership of application directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
