## Dynamics API Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/ibnfaroukroqay/dynamics)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/:vendor_slug/:package_slug/run-tests?label=tests)](https://github.com/ibnfaroukroqay/dynamics/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ibnfaroukroqay/dynamics/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/ibnfaroukroqay/dynamics/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibnfaroukroqay/dynamics.svg?style=flat-square)](https://packagist.org/packages/ibnfaroukroqay/dynamics)

This package is a wrapper for Microsoft Dynamics integration .

## Installation

You can install the package via composer:

```bash
composer require ibnfaroukroqay/dynamics
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="dynamics-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="dynamics-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="dynamics-views"
```

## Usage

```php
use Ibnfaroukroqay\Dynamics\Dynamics;

$dynamics = new Dynamics();
$response = $dynamics->sendRequst($endpoint,$data);

// or using Facade
use Ibnfaroukroqay\Dynamics\Facades\Dynamics;

$response = Dynamics::sendRequest($endpoint,$data)
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Abdullah Farouk](https://github.com/ibnfroukroqay)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
