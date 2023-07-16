# accountant
скопировать .env

docker exec -it accountant-app php artisan key:generate

docker exec -it accountant-app php artisan migrate

docker exec -it accountant-app php artisan db:seed
