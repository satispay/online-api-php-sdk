# Satispay Online API PHP SDK
[![Packagist Version](https://img.shields.io/packagist/v/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)
[![Packagist Downloads](https://img.shields.io/packagist/dt/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)

## Composer Installation
Run the following command:

```bash
composer require satispay/online-api-php-sdk
```

## Manual Installation
If you do not wish to use Composer, `require_once` the `init.php` file.

```php
require_once('/path/init.php');
```

## Getting Started
```php
$api = new \SatispayOnline\Api();
$api->authenticateWithToken("XXXXXX");
```

## API Documentation
https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html
