## Currency converter

**Stack:**  
* Framework: Laravel 5.5  [laravel.com](https://laravel.com/docs/5.5)
* jQuery: 3.2.1  [jquery.com](https://jquery.com/)

Clone repository and [configure](https://laravel.com/docs/5.5#configuration), after that execute:

```
composer install
npm install
php artisan migrate --seed
php artisan currency_rates:save
npm run production
php artisan serve
```
Go to [localhost:8000](https://localhost:8000)

For hourly currencies updating you need to [configure](https://laravel.com/docs/5.5/scheduling#introduction) cron for laravel 