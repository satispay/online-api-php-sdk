# Satispay Online API PHP SDK
[![Packagist Version](https://img.shields.io/packagist/v/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)
[![Packagist Downloads](https://img.shields.io/packagist/dt/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)

## Deprecated API
For new integrations please use https://github.com/satispay/gbusiness-api-php-sdk.

## Installation
Run the following command:

```bash
composer require satispay/online-api-php-sdk
```

If you do not wish to use Composer, import the `init.php` file.

```php
require_once("/path/init.php");
```

## Documentation
https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html

## Authenticate with Bearer
Sign in to your [Dashboard](https://business.satispay.com) at [business.satispay.com](https://business.satispay.com), click "Negozi Online", click on "Crea codice di attivazione" and select "Security bearer" on top menu.

```php
\SatispayOnline\Api::setSecurityBearer("osh_...");
```

## Authenticate with RSA Signature
Sign in to your [Dashboard](https://business.satispay.com) at [business.satispay.com](https://business.satispay.com), click "Negozi Online", and then click on "Genera un token di attivazione" to generate an activation token.

Use the activation token with the `authenticateWithToken` function to generate and exchange a pair of RSA keys.

Save the keys in your database or in a **safe place** not accesibile from your website.
```php
// Authenticate and generate the keys
$authentication = \SatispayOnline\Api::authenticateWithToken("XXXXXX");

// Export keys
$publicKey = $authentication->publicKey;
$privateKey = $authentication->privateKey;
$keyId = $authentication->keyId;
```

Reuse the keys after authentication.
```php
// Keys variables
$publicKey = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhk...";
$privateKey = "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBg...";
$keyId = "ldg9sbq283og7ua1abpj989kbbm2g60us6f18c1sciq...";

// Set keys
\SatispayOnline\Api::setPublicKey($publicKey);
\SatispayOnline\Api::setPrivateKey($privateKey);
\SatispayOnline\Api::setKeyId($keyId);

// Test the authentication
\SatispayOnline\Api::testAuthentication();
```

## Enable Sandbox
To enable sandbox use `setSandbox` function.
```php
\SatispayOnline\Api::setSandbox(true);
```
