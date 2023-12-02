# Algolia With Laravel

## Required platform

- PHP 7.3 - 8.0
- MySQL
- Composer

## How to setup project?

##### Follow below steps:

- If windows run `copy .env.example .env` else `cp .env.example .env`
- create database and set database credentials on `.env` file
- Run `composer i`
- Run `php artisan migrate`
- Set algolia details in .env `ALGOLIA_APP_ID & ALGOLIA_SECRET`
