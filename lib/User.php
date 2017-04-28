<?php
namespace Satispay;

use Satispay\Satispay;

class User {
  public static function create($params = null) {
    $result = Satispay::request('/online/v1/users', 'POST', $params);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 52:
          throw new \Exception('Shop validation error');
          break;
        case 36:
          throw new \Exception('Phone number required');
          break;
        case 39:
          throw new \Exception('Invalid phone number');
          break;
        case 49:
          throw new \Exception('The phone number isn’t from a registered user');
          break;
      }
    }
    return $body;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Satispay::request('/online/v1/users?'.$queryString);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 52:
          throw new \Exception('Beneficiary validation error');
          break;
      }
    }
    return $body;
  }

  public static function get($id) {
    $result = Satispay::request('/online/v1/users/'.$id);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 41:
          throw new \Exception('UserShop don’t exist');
          break;
      }
    }
    return $body;
  }
}
