## Satispay Online API PHP SDK

### Check Bearer

```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

try {
  \Satispay\Bearer:check();
  echo 'OK';
} catch(\Exception $ex) {
  echo 'Invalid Security Bearer';
}
```

### Users

#### Create a user
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$user = \Satispay\User::create([
  'phone_number' => '+390000000000'
]);
```

#### Get a user list
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$users = \Satispay\User::all();
```

#### Get a user
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$user = \Satispay\User::get('userid');
```

### Charges

#### Create a charge
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$charge = \Satispay\Charge::create([
  'user_id' => 'userid',
  'currency' => 'EUR',
  'amount' => 1000
]);
```

#### Get a charge list
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$charges = \Satispay\Charge::all();
```

#### Get a charge
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$charge = \Satispay\Charge::get('chargeid');
```

#### Update a charge
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$charge = \Satispay\Charge::update('chargeid', [
  'description' => 'newdescription'
]);
```

### Refunds

#### Create a refund
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$refund = \Satispay\Refund::create([
  'charge_id' => 'chargeid',
  'currency' => 'EUR',
  'amount' => 1000
]);
```

#### Get a refund list
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$refunds = \Satispay\Refund::all();
```

#### Get a refund
Example:
```php
\Satispay\Satispay::setSecurityBearer('yoursecuritybearer');

$refund = \Satispay\Refund::get('refundid');
```
