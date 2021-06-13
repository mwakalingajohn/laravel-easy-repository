# Simple repository pattern for laravel, with services!

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mwakalingajohn/laravel-easy-repository.svg?style=flat-square)](https://packagist.org/packages/mwakalingajohn/laravel-easy-repository)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/mwakalingajohn/laravel-easy-repository/run-tests?label=tests)](https://github.com/mwakalingajohn/laravel-easy-repository/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/mwakalingajohn/laravel-easy-repository/Check%20&%20fix%20styling?label=code%20style)](https://github.com/mwakalingajohn/laravel-easy-repository/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mwakalingajohn/laravel-easy-repository.svg?style=flat-square)](https://packagist.org/packages/mwakalingajohn/laravel-easy-repository)

## Installation

You can install the package via composer:

```bash
composer require mwakalingajohn/laravel-easy-repository
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Mwakalingajohn\LaravelEasyRepository\LaravelEasyRepositoryServiceProvider" --tag="laravel-easy-repository-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Mwakalingajohn\LaravelEasyRepository\LaravelEasyRepositoryServiceProvider" --tag="laravel-easy-repository-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-easy-repository = new Mwakalingajohn\LaravelEasyRepository();
echo $laravel-easy-repository->echoPhrase('Hello, Spatie!');
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

-   [John Mwakalinga](https://github.com/mwakalingajohn)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
