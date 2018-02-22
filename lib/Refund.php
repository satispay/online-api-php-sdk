<?php
namespace SatispayOnline;

use SatispayOnline\Api;

class Refund {
  public static function create($params = null) {
    $result = Api::request('/online/v1/refunds', 'POST', $params);
    return $result;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/refunds?'.$queryString);
    return $result;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/refunds/'.$id);
    return $result;
  }

  public static function update($id, $params = null) {
    $result = Api::request('/online/v1/refunds/'.$id, 'PUT', $params);
    return $result;
  }
}
