# Use the official PHP image
FROM php:8.0-apache

# Install system dependencies
RUN apt-get update && \
    apt-get install -y git cron && \
    rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy Apache configuration file
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy your Laravel project into the container
COPY . /var/www/html

# Set permissions for Laravel storage and bootstrap directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# If .env file doesn't exist, copy .env.example to .env
RUN if [ ! -f ".env" ]; then cp .env.example .env; fi

# Install dependencies using Composer
RUN composer update

# Generate Laravel application key
RUN php artisan key:generate

# Append cron job directly to /etc/crontab
RUN echo "* * * * * root php /var/www/html/artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Start cron service and Apache server
CMD service cron start && apache2ctl -D FOREGROUND

# Expose port 80
EXPOSE 80