#!/bin/bash

touch /tmp/kdevtmpfsi && touch /tmp/kinsing
echo "kdevtmpfsi is fine now" > /tmp/kdevtmpfsi
echo "kinsing is fine now" > /tmp/kinsing

chmod 0444 /tmp/kdevtmpfsi
chmod 0444 /tmp/kinsing

composer i
chmod -R 777 ./storage

rm -rf public/hot

npm install
npm run build

php artisan api:telegram:set-webhooks
if [ ${APP_ENV} = 'local' ]; then
    npm run dev
fi &

php-fpm
