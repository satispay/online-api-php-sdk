<?php
require_once("../init.php");

$dataJson = file_get_contents("keys.json");
$data = json_decode($dataJson);

$api = new \SatispayOnline\Api([
  "publicKey" => $data->publicKey,
  "privateKey" => $data->privateKey,
  "keyId" => $data->keyId,
  "serverPublicKey" => $data->serverPublicKey,
  "env" => "test"
]);

$result = $api->testAuthentication();

var_dump($result);
