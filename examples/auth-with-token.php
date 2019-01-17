<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

\SatispayOnline\Api::authenticateWithToken("L88B34");

$publicKey = \SatispayOnline\Api::getPublicKey();
$privateKey = \SatispayOnline\Api::getPrivateKey();
$keyId = \SatispayOnline\Api::getKeyId();

file_put_contents("authentication.json", json_encode(array(
  "public_key" => $publicKey,
  "private_key" => $privateKey,
  "key_id" => $keyId
), JSON_PRETTY_PRINT));
