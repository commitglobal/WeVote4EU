#!/command/with-contenv sh

cd /var/www

php artisan migrate --force
php artisan storage:link

php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache

php artisan about
