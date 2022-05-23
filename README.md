# Test Manager

Prosty system do zarządzania testami.

## Instalacja:

git clone https://github.com/usdarys/test-manager.git
cd test-manager
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npx mix --production