# Laravel ArQuery

This laravel app is an example of using The query builder from [ArUtil Library](https://github.com/alhoqbani/ar-php).


## Installation:

```
git clone https://github.com/alhoqbani/laravel-ar-query.git
cd laravel-ar-query
composer install
cp .env.example .env
php artisan key:generate
```
#### Database:
You need to update the `.env` file with your database details

In example `.env`, the database name is laravel_ar_query, username: root, and empty password.
Change it according to your details.

After setting up the database you need to run these commands to populate the data:
```
php artisan migrate
php artisan db:seed
```
Finally, run the application:
```
php artisan serve
```
And point your browser to `http://127.0.0.1:8000`

