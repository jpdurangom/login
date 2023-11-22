# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Copy only the composer files
COPY composer.json /var/www/html/

# Install dependencies and generate composer.lock
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . /var/www/html

# Run composer to autoload dependencies
RUN composer dump-autoload --optimize

# Make port 80 available to the world outside this container
EXPOSE 80

# Define environment variables
ENV MYSQL_HOST=mysql
ENV MYSQL_PORT=3306
ENV MYSQL_DATABASE=mydatabase
ENV MYSQL_USER=myuser
ENV MYSQL_PASSWORD=mypassword

# Start Apache
CMD ["apache2-foreground"]
