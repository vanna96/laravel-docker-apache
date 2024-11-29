# Use the official PHP image
FROM php:8.0-apache

# Install system dependencies
RUN apt-get update && \
    apt-get install -y git cron supervisor && \
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

# Append cron job directly to /etc/crontab
RUN echo "* * * * * root php /var/www/html/artisan schedule:run >> /var/www/html/storage/logs/laravel.log 2>&1" >> /etc/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Create worker.log file
RUN touch /var/www/html/storage/logs/worker.log

# Set permissions for worker.log
RUN chown www-data:www-data /var/www/html/storage/logs/worker.log
RUN chmod 664 /var/www/html/storage/logs/worker.log

# Configure Supervisor
COPY supervisor/queue-worker.conf /etc/supervisor/conf.d/queue-worker.conf

# Start Supervisor
# CMD supervisord -c /etc/supervisor/conf.d/queue-worker.conf && service cron start && apache2ctl -D FOREGROUND
CMD ["sh", "-c", "supervisord -c /etc/supervisor/conf.d/queue-worker.conf && service cron start && apache2ctl -D FOREGROUND"]

# Expose port 80
EXPOSE 80