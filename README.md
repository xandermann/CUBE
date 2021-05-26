# GoodFood

## Installation:

    $ make install # (peut prendre longtemps selon les connexions)

    $ vi backend/.env # (fonctionne sur localhost par défaut)
    $ make dev # Recharge le fichier .env

    $ make migrate
    * ou *
    $ make fresh

    $ make test

## Commandes utiles

    $ make

## Liens utiles : développement local par défaut

- [API Backend - localhost](localhost/api) - `make route` pour voir les routes
- [Frontend - localhost:8000](localhost:8000)
- [Frontend admin - localhost:8001](localhost:8001)
- [Adminer - localhost:8080](localhost:8080)
- [Mail - localhost:1080](localhost:1080) a envoyer sur `mail:25` par défaut

## Production

    $ make prod

**Attention**: la configuration utilisée est propre au serveur de pré-production car nous utilisons un serveur proxy externe à l'application. Le proxy permet de réaliser des redirections automatiques, gérer les requêtes HTTP 2, gère les requêtes HTTPS, et génère automatiquement les certificats HTTPS aux domaines correspondants.

Cette partie est externalisée car elle ne fait pas partie en elle même de l'application, et contient des secrets propre à la configuration utilisée. (exemple: configurations nginx, certificats HTTPS...)

Elle n'est pas requise pour le bon fonctionnement du projet. Elle est cependant gardée dans le code source pour contextualiser le projet CUBE / CESI, et justifier comment il fonctionne.
