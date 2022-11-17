## ENVIRONMENT:
- sudo apt install mysql-server
- sudo apt install apache2
- sudo apt install php8.1

## LOCAL, DEV, STG, PROD Commands:
- composer install
- touch .env, and paste .env.example content into .env file
- php artisan key:generate
- php artisan config:cache
- php artisan optimize:clear

## LOCAL TEST Commands:
- php artisan schedule:run

## PROD Commands without database (Jobs work synchronously): 
- cd /
- crontab -e
- * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
- sudo systemctl start cron
- sudo systemctl status cron

## PROD Commands with database (Jobs work in queue database)
- sudo apt update && sudo apt install supervisor
- cd /etc/supervisor/conf.d/queue.conf
    # Add this lines into this file, and setup your environment path--
-   [program:laravel-worker]
-   process_name=%(program_name)s_%(process_num)02d
-   command=php /home/forge/app.com/artisan queue:work --default --sleep=3 --tries=3 --max-time=3600
-   autostart=true
-   autorestart=true
-   stopasgroup=true
-   killasgroup=true
-   user=forge
-   numprocs=8
-   redirect_stderr=true
-   stdout_logfile=/home/forge/app.com/worker.log
-   stopwaitsecs=3600

- supervisorctl reread
- supervisorctl update
- supervisorctl restart all

- cd /
- crontab -e
- * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
- sudo systemctl start cron
- sudo systemctl status cron

- php artisan queue:table
- php artisan migrate
- php artisan optimize:clear

## PROD Commands with Redis (db connection no) (Jobs work in queue redis)
- Same environment like for database only one change in .env file

- command=php /home/forge/app.com/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis
SESSION_DRIVER=file
SESSION_LIFETIME=120


