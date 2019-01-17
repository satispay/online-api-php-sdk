<?php
namespace SatispayOnline;

class Charge {
  /**
   * Create charge
   * @param array $body Charge body
  */
  public static function create($body) {
    return Request::post("/online/v1/charges", array(
      "body" => $body,
      "sign" => true
    ));
  }

  /**
   * Get charge
   * @param string $id Charge id
  */
  public static function get($id) {
    return Request::get("/online/v1/charges/$id", array(
      "sign" => true
    ));
  }

  /**
   * Get charges list
   * @param array $options Options
  */
  public static function all($options = array()) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return Request::get("/online/v1/charges$queryString", array(
      "sign" => true
    ));
  }

  /**
   * Update charge
   * @param string $id Charge id
   * @param array $body Charge body
  */
  public static function update($id, $body) {
    return Request::put("/online/v1/charges/$id", array(
      "body" => $body,
      "sign" => true
    ));
  }
}
