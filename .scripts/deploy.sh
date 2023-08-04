#!/bin/bash
set -e

echo "Deployment started ..."

# Entrer en mode maintenance ou retourner true
# Si le site est déjà en mode maintenance
(php artisan down) || true

# Pull la dernière version de l'application.
git pull origin main

# Installation des dépendances avec composer
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Nettoyez l'ancien cache
php artisan clear-compiled

# Récréer le cache
php artisan optimize

# Compile npm assets
npm run prod

# Lancez database migrations
php artisan migrate --force

# Sortir du mode maintenancer
php artisan up

echo "Deployment finished!"