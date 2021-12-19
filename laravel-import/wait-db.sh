#!/bin/sh
failcounter=0
timeout_in_sec=180
until docker-compose exec db mysqladmin --user="root" --password=${MYSQL_ROOT_PASSWORD} --host="db" ping --silent &> /dev/null ; do
    let "failcounter += 1"
    echo "Installing database... > $failcounter"
    if [[ $failcounter -gt timeout_in_sec ]]; then
      echo "Timeout ($timeout_in_sec seconds) reached; failed to connect to database"
      exit 1
    fi
    sleep 2
done
echo "Creating database..."
sleep 1