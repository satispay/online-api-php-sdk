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
  public $checkouts;
  public $refunds;
  public $request;
  public $users;

  /**
   * Api constructor
   * @param array $options Api options
  */
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
    $this->checkouts = new Checkouts($this);
    $this->refunds = new Refunds($this);
    $this->request = new Request($this);
    $this->users = new Users($this);
  }

  /**
   * Generate new keys and authenticate with token
   * @param string $token Authentication token
  */
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

  /**
   * Test authentication keys
   * @return object Test authentication response
  */
  public function testAuthentication() {
    return $this->request->post("/wally-services/protocol/tests", [
      "body" => [
        "hello" => "world"
      ],
      "sign" => true
    ]);
  }

  /**
   * Get env value
   * @return string Env value
  */
  public function getEnv() {
    return $this->env;
  }

  /**
   * Get private key value
   * @return string Private key value
  */
  public function getPrivateKey() {
    return $this->privateKey;
  }

  /**
   * Get public key value
   * @return string Public key value
  */
  public function getPublicKey() {
    return $this->publicKey;
  }

  /**
   * Get server public key value
   * @return string Server public key value
  */
  public function getServerPublicKey() {
    return $this->serverPublicKey;
  }

  /**
   * Get key id value
   * @return string Key id value
  */
  public function getKeyId() {
    return $this->keyId;
  }

  /**
   * Get version value
   * @return string Version value
  */
  public function getVersion() {
    return $this->version;
  }
}
