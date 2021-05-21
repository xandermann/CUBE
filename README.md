# GoodFood

## Installation:

    $ make install # (peut prendre longtemps selon les connexions)

    $ vi backend/.env

    $ docker-compose down && docker-compose up -d # Recharge le fichier .env

    $ make migrate
    * ou *
    $ make fresh

    $ make test

## Commandes utiles

    $ make

## Production

    $ make prod

**Attention**: la configuration utilisée est propre au serveur de pré-production car nous utilisons un serveur proxy externe à l'application. Le proxy permet de réaliser des redirections automatiques, gérer les requêtes HTTP 2, gère les requêtes HTTPS, et génère automatiquement les certificats HTTPS aux domaines correspondants.

Cette partie est externalisée car elle ne fait pas partie en elle même de l'application, et contient des secrets propre à la configuration utilisée. (exemple: certificats HTTPS)

Elle n'est pas requise pour le bon fonctionnement du projet. Elle est cependant gardée dans le code source pour contextualiser le projet CUBE / CESI, et justifier comment il fonctionne.
