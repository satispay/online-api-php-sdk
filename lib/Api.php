<?php
namespace SatispayOnline;

class Api {
  private static $env = "production";
  private static $privateKey;
  private static $publicKey;
  private static $keyId;
  private static $securityBearer;
  private static $version = "2.0.0";
  private static $authservicesUrl = "https://authservices.satispay.com";

  /**
   * Api constructor
   * @param array $options Api options
  */
  // public function __construct($options = []) {
  //   if (!empty($options["env"])) {
  //     $this->env = $options["env"];
  //   }

  //   if (!empty($options["privateKey"])) {
  //     $this->privateKey = $options["privateKey"];
  //   }

  //   if (!empty($options["publicKey"])) {
  //     $this->publicKey = $options["publicKey"];
  //   }

  //   if (!empty($options["keyId"])) {
  //     $this->keyId = $options["keyId"];
  //   }

  //   if (!empty($options["securityBearer"])) {
  //     $this->securityBearer = $options["securityBearer"];
  //   }

  //   if (!empty($options["sandbox"]) && $options["sandbox"] === true) {
  //     $this->env = "staging";
  //   }

  //   // $this->amounts = new Amounts($this);
  //   // $this->charges = new Charges($this);
  //   // $this->checkouts = new Checkouts($this);
  //   // $this->refunds = new Refunds($this);
  //   // $this->request = new Request($this);
  //   // $this->users = new Users($this);
  // }

  /**
   * Generate new keys and authenticate with token
   * @param string $token Authentication token
  */
  public static function authenticateWithToken($token) {
    $pkeyResource = openssl_pkey_new(array(
      "digest_alg" => "sha256",
      "private_key_bits" => 2048
    ));

    openssl_pkey_export($pkeyResource, $generatedPrivateKey);

    $pkeyResourceDetails = openssl_pkey_get_details($pkeyResource);
    $generatedPublicKey = $pkeyResourceDetails["key"];

    $requestResult = Request::post("/g_business/v1/authentication_keys", array(
      "body" => array(
        "public_key" => $generatedPublicKey,
        "token" => $token
      )
    ));

    self::$privateKey = $generatedPrivateKey;
    self::$publicKey = $generatedPublicKey;
    self::$keyId = $requestResult->key_id;
  }

  /**
   * Test authentication keys
  */
  public static function testAuthentication() {
    $result = Request::get("/wally-services/protocol/tests/signature", array(
      "sign" => true
    ));

    if ($result->authentication_key->role !== "ONLINE_SHOP") {
      throw new \Exception("Invalid authentication");
    }

    return $result;
  }

  /**
   * Get env
   * @return string
  */
  public static function getEnv() {
    return self::$env;
  }
  /**
   * Set env
   * @param string $value
  */
  public static function setEnv($value) {
    self::$env = $value;
    if ($value == "production") {
      self::$authservicesUrl = "https://authservices.satispay.com";
    } else {
      self::$authservicesUrl = "https://".$value.".authservices.satispay.com";
    }
  }

  /**
   * Get private key
   * @return string
  */
  public static function getPrivateKey() {
    return self::$privateKey;
  }
  /**
   * Set private key
   * @param string $value
  */
  public static function setPrivateKey($value) {
    self::$privateKey = $value;
  }

  /**
   * Get public key
   * @return string
  */
  public static function getPublicKey() {
    return self::$publicKey;
  }
  /**
   * Set public key
   * @param string $value
  */
  public static function setPublicKey($value) {
    self::$publicKey = $value;
  }

  /**
   * Get key id
   * @return string
  */
  public static function getKeyId() {
    return self::$keyId;
  }
  /**
   * Set key id
   * @param string $value
  */
  public static function setKeyId($value) {
    self::$keyId = $value;
  }

  /**
   * Get version 
   * @return string
  */
  public static function getVersion() {
    return self::$version;
  }

  /**
   * Get authservices url 
   * @return string
  */
  public static function getAuthservicesUrl() {
    return self::$authservicesUrl;
  }

  /**
   * Get security bearer
   * @return string Security bearer value
  */
  public static function getSecurityBearer() {
    return self::$securityBearer;
  }
  /**
   * Set security bearer
   * @param string $securityBearer
  */
  public static function setSecurityBearer($securityBearer) {
    self::$securityBearer = $securityBearer;
  }

  /**
   * Is sandbox enabled?
   * @return boolean
  */
  public static function getSandbox() {
    if (self::$env == "staging") {
      return true;
    } else {
      return false;
    }
  }
  /**
   * Enable or disable sandbox
   * @param boolean $value
  */
  public static function setSandbox($value) {
    if ($value == true) {
      self::setEnv("staging");
    } else {
      self::setEnv("production");
    }
  }
}
