git clone http://github.com/mjvamorim/condo-vue

cd condo-vue
cp .env.example .env
php artisan migrate:fresh
php artisan db:seed

composer install
npm install
npm run watch

php artisan serve
http://localhost:8000
