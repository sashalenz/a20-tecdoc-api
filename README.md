# Client for Tecdoc API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sashalenz/a20-tecdoc-api.svg?style=flat-square)](https://packagist.org/packages/sashalenz/a20-tecdoc-api)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/sashalenz/a20-tecdoc-api/run-tests?label=tests)](https://github.com/sashalenz/a20-tecdoc-api/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/sashalenz/a20-tecdoc-api/Check%20&%20fix%20styling?label=code%20style)](https://github.com/sashalenz/a20-tecdoc-api/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/sashalenz/a20-tecdoc-api.svg?style=flat-square)](https://packagist.org/packages/sashalenz/a20-tecdoc-api)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require sashalenz/a20-tecdoc-api
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Sashalenz\Tecdoc\TecdocServiceProvider" --tag="a20-tecdoc-api-config"
```

This is the contents of the published config file:

```php
return [
    'url' => env('TECDOC_URL', null),
    'key' => env('TECDOC_KEY', null),
    'middleware' => env('TECDOC_ROUTE_MIDDLEWARE', 'web')
];
```

## Usage

```php
$tecdocBrand = new Sashalenz\Tecdoc\ApiModels\Brand();
echo $tecdocBrand->get('BMW');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Oleksandr Petrovskyi](https://github.com/sashalenz)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
