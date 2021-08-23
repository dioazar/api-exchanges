# Dionel Azar Exchange rates API

## Install without docker
Set  your `.env` file and run commands:

`composer install`

`php artisan migrate --seed`

`php artisan insertLastTwoYears`

`php artisan l5-swagger:generate`

`php artisan optimize`

## Install with docker


## Use
This application has front end and an api.

All api endpoints start with `{domain}/api/v1/`

The endpoints are:

`{domain}/api/v1/currencies`

`{domain}/api/v1/currencies/list`

`{domain}/api/v1/currencies/filters?currency_code={cc}&date_from={df}&date_to={dt}`

`{domain}/api/v1/currencies/{currency_code}/last`

## Testing
Run `php artisan test`
