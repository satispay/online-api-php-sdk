<?php
namespace SatispayOnline;

use SatispayOnline\Api;

class Refund {
  public static function create($params = null) {
    $result = Api::request('/online/v1/refunds', 'POST', $params);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 36:
          throw new \Exception('Body validation error');
          break;
        case 45:
          throw new \Exception('Try to create a refund for a Charge not owned by user');
          break;
        case 52:
          throw new \Exception('Beneficiary validation');
          break;
      }
    }
    return $body;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/refunds?'.$queryString);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 45:
          throw new \Exception('Try to get a refund of another shop');
          break;
        case 52:
          throw new \Exception('Beneficiary validation');
          break;
      }
    }
    return $body;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/refunds/'.$id);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 41:
          throw new \Exception('Refund does not exist');
          break;
        case 45:
          throw new \Exception('Try to get a refund of another shop');
          break;
        case 52:
          throw new \Exception('Shop validation error');
          break;
      }
    }
    return $body;
  }

  public static function update($id, $params = null) {
    $result = Api::request('/online/v1/refunds/'.$id, 'PUT', $params);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 45:
          throw new \Exception('Try to update a refund of another user');
          break;
        case 52:
          throw new \Exception('Beneficiary validation');
          break;
        case 36:
          throw new \Exception('Body validation error');
          break;
        case 41:
          throw new \Exception('Refund don’t exist');
          break;
      }
    }
    return $body;
  }
}
