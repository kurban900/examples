#!/usr/bin/env bash



 while [ true ]
    do
      php /var/www/app/artisan queue:work --daemon --queue=do-work --sleep=3 --tries=3 &
      sleep 10
    done
