#!/bin/bash
set -e

# Esperar a que MySQL esté listo
echo "Esperando a que MySQL esté disponible..."
until php -r "new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" &> /dev/null; do
    echo "MySQL no está listo - esperando..."
    sleep 2
done

echo "MySQL está listo!"

# Instalar dependencias de Composer si no existen
if [ ! -d "vendor" ]; then
    echo "Instalando dependencias de Composer..."
    composer install --no-interaction --optimize-autoloader
fi

# Generar key si no existe en .env
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generando APP_KEY..."
    php artisan key:generate
fi

# Dar permisos a las carpetas necesarias
echo "Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Limpiar caché
echo "Limpiando caché..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "¡Aplicación lista!"

# Ejecutar el comando pasado al contenedor
exec "$@"