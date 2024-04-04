. Note:
    . to start project
        . RUN `install docker container`
        . RUN `docker-compose up -d` up docker-compose file to run all in dokcer-compose
        . RUN `docker exec -it laravel-web-apache bash` to access directory project
        . RUN `composer install or compose update`
        . RUN `php artisan migrate`
        . if suppervisor not working RUN `supervisord -c /etc/supervisor/conf.d/queue-worker.conf`