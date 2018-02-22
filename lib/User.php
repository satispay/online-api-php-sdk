<?php
namespace SatispayOnline;

use SatispayOnline\Api;

class User {
  public static function create($params = null) {
    $result = Api::request('/online/v1/users', 'POST', $params);
    return $result;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/users?'.$queryString);
    return $result;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/users/'.$id);
    return $result;
  }
}
