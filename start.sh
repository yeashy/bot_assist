#!/bin/bash

#cat ".env.${APP_ENV}" > .env

chmod -R 777 ./storage

composer i

npm install
npm run build

php artisan api:telegram:set-webhooks
npm run dev &

php-fpm
