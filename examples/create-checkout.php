<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authData = json_decode(file_get_contents("authentication.json"));

\SatispayOnline\Api::setPublicKey($authData->public_key);
\SatispayOnline\Api::setPrivateKey($authData->private_key);
\SatispayOnline\Api::setKeyId($authData->key_id);

$checkout = \SatispayOnline\Checkout::create(array(
  "phone_number" => "",
  "amount_unit" => 199,
  "currency" => "EUR",
  "description" => "",
  "redirect_url" => ""
));

var_dump($checkout);
