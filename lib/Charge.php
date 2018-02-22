<?php
namespace SatispayOnline;

use SatispayOnline\Api;

/**
 * @property string $user_id
 * @property string $description
 * @property string $currency
 * @property int    $amount
 * @property array  $metadata
 * @property bool   $required_success_email
 * @property int    $expire_in
 * @property string $callback_url
 */
class Charge {
  /**
   * @param  array  $params
   * @return object
   */
  public static function create($params = null) {
    $result = Api::request('/online/v1/charges', 'POST', $params);
    return $result;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/charges?'.$queryString);
    return $result;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/charges/'.$id);
    return $result;
  }

  public static function update($id, $params = null) {
    $result = Api::request('/online/v1/charges/'.$id, 'PUT', $params);
    return $result;
  }
}
