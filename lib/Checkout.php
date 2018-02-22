<?php
namespace SatispayOnline;

use SatispayOnline\Api;

/**
 * @property string $description
 * @property string $phone_number
 * @property string $redirect_url
 * @property string $callback_url
 * @property int    $amount_unit
 * @property string $currency
 * @property int    $expire_in
 */
class Checkout {
  /**
   * @param  array  $params
   * @return object
   */
  public static function create($params = null) {
    $result = Api::request('/online/v1/checkouts', 'POST', $params);
    return $result;
  }
}
