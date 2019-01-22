<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authentication = \SatispayOnline\Api::authenticateWithToken("L88B34");

$publicKey = $authentication->publicKey;
$privateKey = $authentication->privateKey;
$keyId = $authentication->keyId;

file_put_contents("authentication.json", json_encode(array(
  "public_key" => $publicKey,
  "private_key" => $privateKey,
  "key_id" => $keyId
), JSON_PRETTY_PRINT));
