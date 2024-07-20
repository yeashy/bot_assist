#!/bin/bash

php artisan api:telegram:set-webhooks
npm run dev &

php-fpm
