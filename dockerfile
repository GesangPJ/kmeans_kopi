# Use an official PHP image as the base image
FROM php:7.4.33-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your CodeIgniter project files into the container
COPY . .

# Install PHP extensions required by your project
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies using Composer
# RUN composer install

# Expose the Apache web server port
EXPOSE 80

# Start the Apache web server
# CMD ["apache2-foreground"]
