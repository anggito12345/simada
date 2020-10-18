docker-compose down
docker-compose build
docker-compose up -d
docker-compose exec app cp ./.env.docker .env
docker-compose exec app chmod -R 777 storage
docker-compose exec app chmod -R 777 bootstrap/cache
docker-compose exec app ./composer.phar install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
