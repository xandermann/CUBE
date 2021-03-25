# GoodFood

## frontend

Contient l'application React

## backend

Contient l'API

```
docker exec -ti cube_composer_1 bash
composer install
cp .env.example .env
vi .env

# Mettre:
DB_CONNECTION=pgsql
DB_HOST=database
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=example

php artisan key:generate

chown -R www-data:www-data .

docker-compose down
docker-compose up -d

```
