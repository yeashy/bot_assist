#!/bin/bash

chmod -R 777 ./storage
chmod -R 777 ./public

composer i

rm -rf public/hot

npm install
npm run build

php artisan api:telegram:set-webhooks
if [ ${APP_ENV} = 'local' ]; then
    npm run dev
fi &

php-fpm
