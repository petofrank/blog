# Use the official PHP 8.1 image as the base image
FROM php:8.1-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set the working directory inside the container to /var/www
WORKDIR /var/www

# Copy the application files from the host to the container
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies using Composer
RUN composer install

# Expose port 9000 for the fastCGI server
EXPOSE 9000

# Define the command that will run when the container starts
CMD ["php-fpm"]
