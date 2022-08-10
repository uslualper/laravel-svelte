## About
This is Laravel project but it uses different technologies in it like svelte, tailwind etc.

### Some Features
* Example of receiving and processing data from different services. See here `app/Modules/Tasks`
* Simple API. See here `routes/api.php`
* Algorithm that creates a weekly work schedule. See here `app/Http/Controllers/TaskController.php`
* A command to pull data. See here `app/Console/Commands/SaveTasks.php`

## Requirements

* [PHP 8.1](https://www.php.net/releases/8.1/en.php)
* [NodeJS 14+](https://nodejs.org/en/)
* [Database (MySQL or MariaDB)](https://www.mysql.com/)

## Installation

1. Create the `.env` file
2. Install the required php packages using `composer install`
3. Run `php artisan key:generate`
4. Run `npm install` to install all npm packages
5. Use `npm run dev` to start vite watch your files
6. Last but not least use `php artisan serve` to start your laravel application

## Database 

1.   `php artisan migrate`
2.   `php artisan db:seed --class=DeveloperSeeder`

## Commands
1.   `php artisan task:save`
