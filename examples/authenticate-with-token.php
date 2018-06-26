<?php
require_once("../init.php");

$api = new \SatispayOnline\Api([
  "env" => "test"
]);

$api->authenticateWithToken("CEA3E4");

$data = json_encode([
  "publicKey" => $api->getPublicKey(),
  "privateKey" => $api->getPrivateKey(),
  "keyId" => $api->getKeyId(),
  "serverPublicKey" => $api->getServerPublicKey(),
]);
file_put_contents("keys.json", $data);
