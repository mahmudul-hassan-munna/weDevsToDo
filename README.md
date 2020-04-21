## For ToDo Application following technologies are used -
 - laravel 6 
 - MySQL
 - Bootstrap 4
 - jQuery

## System Requirements

 - PHP >= 7.2.5
 - MySQL

## Database Set Up

There are 2 ways to set up database. You can folow any one of them.

First Way:

- Browse localhost/phpmyadmin/
- Import wedevs.sql 

wedevs.sql is present at root directory

Second Way:

- Browse localhost/phpmyadmin/
- Run command : CREATE DATABASE wedevs;
- Go to the root directory of project and open Command Prompt
- Run Command : php artisan migrate

## Run Project

There are 2 ways to run the project. You can folow any one of them.

First Way:

- Put the project in htdocs folder
- Browse http://localhost/weDevs/public/ 

Second Way:

- Go to the root directory of project and open Command Prompt
- Run Command : php artisan serve


## You can change database name, database password from .env file which is located at root directory
