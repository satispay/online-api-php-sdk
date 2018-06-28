# Satispay Online API PHP SDK
[![Packagist Version](https://img.shields.io/packagist/v/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)
[![Packagist Downloads](https://img.shields.io/packagist/dt/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)

## Installation
Run the following command:

```bash
composer require satispay/online-api-php-sdk
```

If you do not wish to use Composer, import the `init.php` file.

```php
require_once('/path/init.php');
```

## Documentation
https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html

## Authentication
Sign in to your [Dashboard](https://business.satispay.com) at [business.satispay.com](https://business.satispay.com), click "Negozi Online" in the menu on the left, and then click on "Genera un token di attivazione" to generate an activation token.

Use the activation token with the `authenticateWithToken` function to generate and exchange a pair of RSA keys.

Save the keys in your database or in a **safe place** not accesibile from your website.
```php
// Initialize an empty Api
$api = new \SatispayOnline\Api();

// Authenticate and generate the keys
$api->authenticateWithToken("XXXXXX");

// Export the keys
$publicKey = $api->getPublicKey();
$privateKey = $api->getPrivateKey();
$keyId = $api->getKeyId();
$serverPublicKey = $api->getServerPublicKey();
```

To reuse the keys after authentication, pass them as an argument in the `\SatispayOnline\Api` constructor.
```php
// Keys variables
$publicKey = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhk...";
$privateKey = "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBg...";
$keyId = "ldg9sbq283og7ua1abpj989kbbm2g60us6f18c1sciq...";
$serverPublicKey = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhk...";

// Pass keys to Api constructor
$api = new \SatispayOnline\Api([
  "publicKey" => $publicKey,
  "privateKey" => $privateKey,
  "keyId" => $keyId,
  "serverPublicKey" => $serverPublicKey
]);

// Test the authentication
try {
  $api->testAuthentication();
} catch(\Exception $ex) {
  echo $ex->message;
  exit;
}
```

## Enable Sandbox
To enable sandbox pass `isSandbox` with value `true` as an argument in the `\SatispayOnline\Api` constructor.
```php
// Pass isSandbox = true to Api constructor
$api = new \SatispayOnline\Api([
  "isSandbox" => true
  // Other arguments
]);
```

You can also use the `setIsSandbox` function.
```php
$api->setIsSandbox(true);
```
