## Satispay Online API PHP SDK

### Check Bearer

```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

try {
  \SatispayOnline\Bearer:check();
  echo 'OK';
} catch(\Exception $ex) {
  echo 'Invalid Security Bearer';
}
```

### Users

#### Create a user
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$user = \SatispayOnline\User::create([
  'phone_number' => '+390000000000'
]);
```

#### Get a user list
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$users = \SatispayOnline\User::all();
```

#### Get a user
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$user = \SatispayOnline\User::get('userid');
```

### Charges

#### Create a charge
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charge = \SatispayOnline\Charge::create([
  'user_id' => 'userid',
  'currency' => 'EUR',
  'amount' => 1000
]);
```

#### Get a charge list
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charges = \SatispayOnline\Charge::all();
```

#### Get a charge
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charge = \SatispayOnline\Charge::get('chargeid');
```

#### Update a charge
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$charge = \SatispayOnline\Charge::update('chargeid', [
  'description' => 'newdescription'
]);
```

### Refunds

#### Create a refund
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$refund = \SatispayOnline\Refund::create([
  'charge_id' => 'chargeid',
  'currency' => 'EUR',
  'amount' => 1000
]);
```

#### Get a refund list
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$refunds = \SatispayOnline\Refund::all();
```

#### Get a refund
Example:
```php
\SatispayOnline\Api::setSecurityBearer('yoursecuritybearer');

$refund = \SatispayOnline\Refund::get('refundid');
```
