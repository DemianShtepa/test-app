## Installation
1. `composer install`
2. `cp .env.example .env`
3. `touch database/database.sqlite`
4. `php artisan migrate`
5. `php artisan test`

## Starting up
1. `php artisan serve`
2. Visit `localhost:8000/api/submit` using Postman with `Accept: application/json` header set
