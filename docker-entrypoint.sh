#!/bin/bash
set -e

# Esperar a que MySQL esté listo
echo "Esperando a que MySQL esté disponible..."
until php -r "new PDO('mysql:host=${DB_HOST};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" &> /dev/null; do
    echo "MySQL no está listo - esperando..."
    sleep 2
done

echo "MySQL está listo!"

# Instalar dependencias de Composer SIEMPRE
echo "Instalando/actualizando dependencias de Composer..."
composer install --no-interaction --optimize-autoloader

# Dar permisos a las carpetas necesarias
echo "Configurando permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

# Ejecutar migraciones (solo si vendor existe)
if [ -d "vendor" ]; then
    echo "Ejecutando migraciones..."
    php artisan migrate --force || echo "Error en migraciones, continuando..."
    
    # Limpiar caché
    echo "Limpiando caché..."
    php artisan config:clear || true
    php artisan route:clear || true
    php artisan view:clear || true
fi

echo "¡Aplicación lista!"

# Ejecutar el comando pasado al contenedor
exec "$@"