<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authData = json_decode(file_get_contents("authentication.json"));

\SatispayOnline\Api::setPublicKey($authData->public_key);
\SatispayOnline\Api::setPrivateKey($authData->private_key);
\SatispayOnline\Api::setKeyId($authData->key_id);

$charges = \SatispayOnline\Charge::all();

var_dump($charges);
