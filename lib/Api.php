<?php
namespace SatispayOnline;

class Api {
  private $env = "production";
  private $privateKey;
  private $publicKey;
  private $serverPublicKey;
  private $keyId;
  private $securityBearer;
  private $version = "2.0.0";

  public $amounts;
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

    if (!empty($options["securityBearer"])) {
      $this->securityBearer = $options["securityBearer"];
    }

    if (!empty($options["sandbox"]) && $options["sandbox"] === true) {
      $this->env = "staging";
    }

    $this->amounts = new Amounts($this);
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
    $pkeyResource = openssl_pkey_new(array(
      "digest_alg" => "sha256",
      "private_key_bits" => 2048
    ));

    openssl_pkey_export($pkeyResource, $generatedPrivateKey);

    $pkeyResourceDetails = openssl_pkey_get_details($pkeyResource);
    $generatedPublicKey = $pkeyResourceDetails["key"];

    $requestResult = $this->request->post("/wally-services/v2/auth/authentication_keys", array(
      "body" => array(
        "public_key" => $generatedPublicKey,
        "token" => $token
      )
    ));

    $this->privateKey = $generatedPrivateKey;
    $this->publicKey = $generatedPublicKey;
    $this->keyId = $requestResult->access_key;
    $this->serverPublicKey = $requestResult->secret_key;
  }

  /**
   * Test authentication keys
  */
  public function testAuthentication() {
    $result = $this->request->post("/wally-services/protocol/tests", array(
      "body" => array(
        "hello" => "world"
      ),
      "sign" => true
    ));

    if ($result->authentication_key->role !== "ONLINE_SHOP") {
      throw new \Exception("Invalid authentication");
    }
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

  /**
   * Get security bearer
   * @return string Security bearer value
  */
  public function getSecurityBearer() {
    return $this->securityBearer;
  }

  // /**
  //  * Get security bearer
  //  * @param string $securityBearer
  // */
  // public function setSecurityBearer($securityBearer) {
  //   $this->securityBearer = $securityBearer;
  // }

  /**
   * Is sandbox enabled?
   * @return boolean
  */
  public function getSandbox() {
    if ($this->env === "staging") {
      return true;
    } else {
      return false;
    }
  }

  // /**
  //  * Enable or disable sandbox
  //  * @param boolean $value
  // */
  // public function setSandbox($value) {
  //   if ($value === true) {
  //     $this->env = "staging";
  //   } else {
  //     $this->env = "production";
  //   }
  // }
}
