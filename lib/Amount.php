<?php
namespace SatispayOnline;

class Amount {
  /**
   * Get amounts
   * @param array $options Options
  */
  public static function all($options = array()) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return Request::get("/online/v1/amounts$queryString", array(
      "sign" => true
    ));
  }
}
