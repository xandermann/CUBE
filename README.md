# GoodFood

## frontend

Contient l'application React

    cp .env.example .env
    vim .env

## backend

Contient l'API

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

    ...

    SESSION_DRIVER=cookie

    ...

    SESSION_DOMAIN=localhost // Laravel domain
    SANCTUM_STATEFUL_DOMAINS=localhost:8000 // SPA domains

    php artisan key:generate

    chown -R www-data:www-data .

    docker-compose down
    docker-compose up -d

# Commandes utiles

    make

# Production

    docker-compose -f docker-compose.prod.yml up -d

**Attention**: la configuration utilisée est propre au serveur de pré-production car nous utilisons un serveur proxy externe à l'application. Le proxy permet de réaliser des redirections automatiques, gérer les requêtes HTTP 2, gère les requêtes HTTPS, et génère automatiquement les certificats HTTPS aux domaines correspondants.

Cette partie est externalisée car elle ne fait pas partie en elle même de l'application, et contient des secrets propre à la configuration utilisée. (exemple: certificats HTTPS)

Elle n'est pas requise pour le bon fonctionnement du projet. Elle est cependant gardée dans le code source pour contextualiser le projet CUBE / CESI, et justifier comment il fonctionne.
