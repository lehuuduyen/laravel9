echo 'Docker exec myphp1...'

winpty docker exec -it myphp1 bash  -c "composer install && php artisan key:generate &&  php artisan migrate:fresh --seed &&  rm -rf public/storage && php artisan storage:link"

