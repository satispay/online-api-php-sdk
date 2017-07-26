<?php
namespace SatispayOnline;

define('SDKVERSION', '1.3.0');

class Api {
  public static $securityBearer;
  public static $urlStaging = 'https://staging.authservices.satispay.com';
  public static $url = 'https://authservices.satispay.com';
  public static $staging = false;
  public static $client = null;

  public static function setSecurityBearer($securityBearer) {
    self::$securityBearer = $securityBearer;
  }

  public static function getSecurityBearer() {
    return self::$securityBearer;
  }

  public static function setStaging($staging) {
    self::$staging = $staging;
  }

  public static function setClient($client) {
    self::$client = $client;
  }

  public static function request($url, $method = null, $params = null) {
    $opts = [];
    $curl = curl_init();
    $method = strtolower($method);

    $api = self::$url;
    if (self::$staging) {
      $opts[CURLOPT_SSL_VERIFYPEER] = false;
      $opts[CURLOPT_SSL_VERIFYHOST] = 0;
      $api = self::$urlStaging;
    }

    $opts[CURLOPT_URL] = $api.$url;
    $opts[CURLOPT_RETURNTRANSFER] = true;

    $headers = array(
      'Authorization: Bearer '.self::$securityBearer,
      'Content-Type: application/json',
      'X-Satispay-Client: '.join(' ', array(
        self::$client,
        'PHP/'.phpversion()
      )),
      'User-Agent: SatispayOnlineApi-PHPSDK/'.SDKVERSION
    );
    $opts[CURLOPT_HTTPHEADER] = $headers;

    if ($method == 'post') {
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = json_encode($params);
    } else if ($method == 'delete') {
      $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
      $opts[CURLOPT_POST] = 1;
    } else if ($method == 'put') {
      $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = json_encode($params);
    } else {
      $opts[CURLOPT_HTTPGET] = 1;
    }

    curl_setopt_array($curl, $opts);

    $rbody = curl_exec($curl);

    $rcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    $error = null;
    if (curl_errno($curl)) {
      $error = curl_error($curl);
    } else {
      curl_close($curl);
    }

    return array(
      'body' => json_decode($rbody),
      'code' => $rcode,
      'error' => $error
    );
  }
}
