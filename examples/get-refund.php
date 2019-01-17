<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authData = json_decode(file_get_contents("authentication.json"));

\SatispayOnline\Api::setPublicKey($authData->public_key);
\SatispayOnline\Api::setPrivateKey($authData->private_key);
\SatispayOnline\Api::setKeyId($authData->key_id);

$refund = \SatispayOnline\Refund::get("f37af3e1-a25c-4924-a8ea-e88a7bbbaea4");

var_dump($refund);
