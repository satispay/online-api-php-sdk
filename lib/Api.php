<?php
/**
 * Satispay Online API PHP SDK
 * Copyright (C) 2017 Satispay <business@satispay.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  @author    Satispay <business@satispay.com>
 *  @copyright 2017 Satispay <business@satispay.com>
 *  @license   http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace SatispayOnline;

class Api {
  public static $securityBearer;
  public static $endpointStaging = 'https://staging.authservices.satispay.com';
  public static $endpoint = 'https://authservices.satispay.com';
  public static $staging = false;
  public static $client = null;
  public static $version = '1.4.0';

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

  public static function getClient() {
    return trim(join(' ', array(
      self::$client,
      'PHP/'.phpversion()
    )));
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

    $headers = array(
      'Authorization: Bearer '.self::$securityBearer,
      'Content-Type: application/json',
      'X-Satispay-Client: '.trim(join(' ', array(
        self::$client,
        'PHP/'.phpversion()
      ))),
      'User-Agent: SatispayOnlineApi-PHPSDK/'.self::$version
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
    } else if ($method == 'patch') {
      $opts[CURLOPT_CUSTOMREQUEST] = 'PATCH';
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
