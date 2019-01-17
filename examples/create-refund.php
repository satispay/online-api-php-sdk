<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authData = json_decode(file_get_contents("authentication.json"));

\SatispayOnline\Api::setPublicKey($authData->public_key);
\SatispayOnline\Api::setPrivateKey($authData->private_key);
\SatispayOnline\Api::setKeyId($authData->key_id);

$refund = \SatispayOnline\Refund::create(array(
  "charge_id" => "6ae4cfd9-5f79-441e-9a94-3dd157708351",
  "amount" => 199,
  "currency" => "EUR"
));

var_dump($refund);
