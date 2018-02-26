<?php
namespace SatispayOnline;

class Api {
  public static $endpointStaging = 'https://staging.authservices.satispay.com';
  public static $endpoint = 'https://authservices.satispay.com';
  public static $version = '1.6.4';

  public static $securityBearer = '';
  public static $staging = false;
  public static $pluginName = '';
  public static $pluginVersion = '';
  public static $platformVersion = '';
  public static $type = 'API';

  public static function setSecurityBearer($securityBearer) {
    self::$securityBearer = $securityBearer;
  }
  public static function getSecurityBearer() {
    return self::$securityBearer;
  }

  public static function setSandbox($sandbox) {
    self::setStaging($sandbox);
  }
  public static function getSandbox() {
    return self::getStaging();
  }
  public static function setStaging($staging) {
    self::$staging = $staging;
  }
  public static function getStaging() {
    return self::$staging;
  }

  public static function getPluginName() {
    return self::$pluginName;
  }
  public static function setPluginName($pluginName) {
    self::$pluginName = $pluginName;
  }

  public static function getPluginVersion() {
    return self::$pluginVersion;
  }
  public static function setPluginVersion($pluginVersion) {
    self::$pluginVersion = $pluginVersion;
  }

  public static function getPlatformVersion() {
    return self::$platformVersion;
  }
  public static function setPlatformVersion($platformVersion) {
    self::$platformVersion = $platformVersion;
  }

  public static function getType() {
    return self::$type;
  }
  public static function setType($type) {
    self::$type = $type;
  }

  public static function getHeaders() {
    return array(
      'Authorization: Bearer '.self::$securityBearer,
      'X-Satispay-Plugin-Name: '.self::getPluginName(),
      'X-Satispay-Plugin-Version: '.self::getPluginVersion(),
      'X-Satispay-Platformv: '.self::getPlatformVersion(),
      'X-Satispay-Type: '.self::getType(),
      'User-Agent: SatispayOnlineApi-PHPSDK/'.self::$version
    );
  }

  public static function request($url, $method = null, $params = null) {
    $opts = array();
    $curl = curl_init();
    $method = strtolower($method);

    $api = self::$endpoint;
    if (self::$staging) {
      $api = self::$endpointStaging;
    }

    $opts[CURLOPT_URL] = $api.$url;
    $opts[CURLOPT_RETURNTRANSFER] = true;

    $headers = self::getHeaders();

    if ($method == 'post') {
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = json_encode($params);
      
      $headers[] = 'Content-Type: application/json';
    } else if ($method == 'put') {
      $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = json_encode($params);

      $headers[] = 'Content-Type: application/json';
    } else if ($method == 'patch') {
      $opts[CURLOPT_CUSTOMREQUEST] = 'PATCH';
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = json_encode($params);

      $headers[] = 'Content-Type: application/json';
    } else {
      $opts[CURLOPT_HTTPGET] = 1;
    }

    $opts[CURLOPT_HTTPHEADER] = $headers;

    curl_setopt_array($curl, $opts);

    $rawBody = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    $errorn = curl_errno($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if (!empty($errorn) && !empty($error)) {
      throw new \Exception($error, $errorn);
    }

    $isSuccess = true;
    if ($status < 200 || $status > 299) {
      $isSuccess = false;
    }

    $body = json_decode($rawBody);

    if (!$isSuccess) {
      if (!empty($body->message) && !empty($body->code)) {
        throw new \Exception($body->message, $body->code);
      } else {
        throw new \Exception('HTTP status response is '.$status);
      }
    }

    return $body;
  }
}
