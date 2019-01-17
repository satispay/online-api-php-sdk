<?php
namespace SatispayOnline;

class Refund {
  /**
   * Create refund
   * @param array $body Refund body
  */
  public static function create($body) {
    return Request::post("/online/v1/refunds", array(
      "body" => $body,
      "sign" => true
    ));
  }

  /**
   * Get refund
   * @param string $id Refund id
  */
  public static function get($id) {
    return Request::get("/online/v1/refunds/$id", array(
      "sign" => true
    ));
  }

  /**
   * Get refunds list
   * @param array $options Options
  */
  public static function all($options = array()) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return Request::get("/online/v1/refunds$queryString", array(
      "sign" => true
    ));
  }

  /**
   * Update refund
   * @param string $id Refund id
   * @param array $body Refund body
  */
  public static function update($id, $body) {
    return Request::put("/online/v1/refunds/$id", array(
      "body" => $body,
      "sign" => true
    ));
  }
}
