#!/bin/sh
set -e

# Attendre que MySQL soit prêt
until php artisan db:monitor > /dev/null 2>&1; do
  echo "Waiting for MySQL to be ready..."
  sleep 1
done

# Premier démarrage : configuration de l'application
if [ ! -f ".env" ]; then
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --force
    php artisan passport:install
fi

# Exécuter les commandes de découverte des packages
php artisan package:discover

# Démarrer PHP-FPM
exec "$@"
