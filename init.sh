#!/bin/bash

cd Attendance
ls
cp .env.example .env 
composer install

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

./vendor/bin/sail up -d
./vendor/bin/sail composer update
./vendor/bin/sail npm install 
./vendor/bin/sail npm run build

sleep 10s #Mandatory for migration

./vendor/bin/sail php artisan migrate:refresh --seed

#chmod +x migrate.sh

#./migrate.sh
exit  

