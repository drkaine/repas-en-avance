#!/bin/bash
set -e

echo "Le script commence"
cd ~/production/repas-en-avance/ &&

# Pull la dernière version de l'application.
echo "pull origin main"
git pull

echo "Le déploiement commence ..."

# Installation des dépendances avec composer
echo "composer install"
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Entrer en mode maintenance ou retourner true
# Si le site est déjà en mode maintenance
echo "(php artisan down) || true"
(php artisan down) || true

# Nettoyez l'ancien cache
echo "php artisan clear-compiled"
php artisan clear-compiled

# Récréer le cache
# echo "php artisan optimize"
# php artisan optimize

# Compile npm assets
echo "npm install"
npm install

# Lancez database migrations
echo "php artisan migrate:fresh"
php artisan migrate:fresh

# Sortir du mode maintenancer
echo "php artisan up"
php artisan up

echo "Déploiement terminé!"