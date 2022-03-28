<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Requirements

- Composer
- PHP 7.4+

## Setup

- Run `cp .env.example .env`
- Install dependencies by running `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate:fresh --seed`

## Testing

The project was built using TDD practice, to run all tests `./vendor/bin/phpunit`

## Notes

To sort the students, run the following command  `php artisan reorder:student`

## api documentation

Swagger UI is one of the most well-known tools for documenting APIs with OAS.
to visit documents `APP_URL/docs`
