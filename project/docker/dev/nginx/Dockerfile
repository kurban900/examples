FROM nginx:1.17-alpine

COPY ./conf.d /etc/nginx/conf.d

COPY cron.sh /usr/local/bin/cron

WORKDIR /app
