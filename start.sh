#!/bin/bash

composer i
chown ${USER}:${USER} -R ./storage/logs

rm -rf public/hot

npm install
npm run build

php artisan api:telegram:set-webhooks
if [ ${APP_ENV} = 'local' ]; then
    npm run dev
fi &

php-fpm
