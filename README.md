## Satispay Online API PHP SDK

[![Packagist Downloads](https://img.shields.io/packagist/v/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)
[![Packagist Version](https://img.shields.io/packagist/dt/satispay/online-api-php-sdk.svg?style=flat-square)](https://packagist.org/packages/satispay/online-api-php-sdk)

## Composer Installation

Run the following command:

`composer require satispay/online-api-php-sdk`

## Manual Installation

If you do not wish to use Composer, require the `init.php` file.

`require_once('/path/init.php');`

## Getting Started

```php
// Set security bearer
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

// Set sandbox, true or false (not mandatory), default false
\SatispayOnline\Api::setSandbox(true);
```

## Documentation

https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html

## Examples

### Check bearer

```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

try {
  \SatispayOnline\Bearer::check();
  echo 'OK';
} catch(\Exception $ex) {
  echo 'Invalid Security Bearer';
}
```

### Users

Create user
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$user = \SatispayOnline\User::create([
  'phone_number' => '+390000000000'
]);
```

Get users
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$users = \SatispayOnline\User::all();
```

Get user
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$user = \SatispayOnline\User::get('userid');
```

### Charges

Create charge
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charge = \SatispayOnline\Charge::create([
  'user_id' => 'userid',
  'currency' => 'EUR',
  'amount' => 1000
]);
```

Get charges
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charges = \SatispayOnline\Charge::all();
```

Get charge
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charge = \SatispayOnline\Charge::get('chargeid');
```

Update charge
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charge = \SatispayOnline\Charge::update('chargeid', [
  'description' => 'newdescription'
]);
```

### Refunds

Create refund
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$refund = \SatispayOnline\Refund::create([
  'charge_id' => 'chargeid',
  'currency' => 'EUR',
  'amount' => 1000
]);
```

Get refunds
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$refunds = \SatispayOnline\Refund::all();
```

Get refund
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$refund = \SatispayOnline\Refund::get('refundid');
```
