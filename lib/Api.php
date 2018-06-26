<?php
namespace SatispayOnline;

class Api {
  private $env = "production";
  private $privateKey;
  private $publicKey;
  private $serverPublicKey;
  private $keyId;
  private $version = "2.0.0";

  public $charges;
  public $request;

  public function __construct($options = []) {
    if (!empty($options["env"])) {
      $this->env = $options["env"];
    }

    if (!empty($options["privateKey"])) {
      $this->privateKey = $options["privateKey"];
    }

    if (!empty($options["publicKey"])) {
      $this->publicKey = $options["publicKey"];
    }

    if (!empty($options["serverPublicKey"])) {
      $this->serverPublicKey = $options["serverPublicKey"];
    }

    if (!empty($options["keyId"])) {
      $this->keyId = $options["keyId"];
    }

    $this->charges = new Charges($this);
    $this->request = new Request($this);
  }

  public function authenticateWithToken($token) {
    $pkeyResource = openssl_pkey_new([
      "digest_alg" => "sha256",
      "private_key_bits" => 2048
    ]);

    openssl_pkey_export($pkeyResource, $generatedPrivateKey);

    $pkeyResourceDetails = openssl_pkey_get_details($pkeyResource);
    $generatedPublicKey = $pkeyResourceDetails["key"];

    $requestResult = $this->request->post("/wally-services/v2/auth/authentication_keys", [
      "body" => [
        "public_key" => $generatedPublicKey,
        "token" => $token
      ]
    ]);

    $this->privateKey = $generatedPrivateKey;
    $this->publicKey = $generatedPublicKey;
    $this->keyId = $requestResult->access_key;
    $this->serverPublicKey = $requestResult->secret_key;
  }

  public function testAuthentication() {
    return $this->request->post("/wally-services/protocol/tests", [
      "body" => [
        "hello" => "world"
      ],
      "sign" => true
    ]);
  }


  public function getEnv() {
    return $this->env;
  }

  public function getPrivateKey() {
    return $this->privateKey;
  }

  public function getPublicKey() {
    return $this->publicKey;
  }

  public function getServerPublicKey() {
    return $this->serverPublicKey;
  }

  public function getKeyId() {
    return $this->keyId;
  }

  public function getVersion() {
    return $this->version;
  }
}
