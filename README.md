## About Repo

-   simple api call that fetched a number of products and then save them into db,
-   periodically update their data according to custom command.
-   list products and view details

### How to get started

-   clone or download repo
-   run composer install
-   run npm install
-   run npm run dev
-   run php artisan key:generate
-   copy .env.exampe to .env
-   create database with name of your choice
-   run php artisan migrate
-   run php artisan serve

### How to feed DB with products data (call external api)

-   run php artisan fetch:products

### How cron job works

-   run php artisan schedule:work (or add it to crontab with project path)
-   it is gonna feed DB with products data

### Tools Used

-   laravel
-   composer
-   git
-   npm
-   bootstrap
-   postman
