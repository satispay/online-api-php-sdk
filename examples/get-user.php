<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authData = json_decode(file_get_contents("authentication.json"));

\SatispayOnline\Api::setPublicKey($authData->public_key);
\SatispayOnline\Api::setPrivateKey($authData->private_key);
\SatispayOnline\Api::setKeyId($authData->key_id);

$user = \SatispayOnline\User::get("c7cfe7ea-ad2b-40f6-8098-253bc701a2b3");

var_dump($user);
