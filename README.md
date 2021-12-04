
cd /var/www/html/server-bsc
sudo git pull
sudo composer install
sudo composer update
sudo cp .env.prod .env
sudo php artisan key:generate
sudo php artisan migrate
sudo php artisan cache:clear
sudo php artisan route:clear
sudo php artisan config:clear
sudo php artisan view:clear
