# Production-ready PHP + Apache image for this project
FROM php:8.2-apache

# Install extensions required by the project
RUN docker-php-ext-install mysqli pdo pdo_mysql \
  && a2enmod rewrite

# Configure Apache DocumentRoot (default is fine: /var/www/html)
WORKDIR /var/www/html

# Copy application code
COPY . /var/www/html

# Ensure uploads directory exists and is writable
RUN mkdir -p /var/www/html/uploads \
  && chown -R www-data:www-data /var/www/html/uploads \
  && chmod -R 775 /var/www/html/uploads

# Expose web port
EXPOSE 80

# Apache is already the default CMD in the base image

