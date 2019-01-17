<?php
namespace SatispayOnline;

class User {
  /**
   * Create user
   * @param array $body
  */
  public static function create($body) {
    return Request::post("/online/v1/users", array(
      "body" => $body,
      "sign" => true
    ));
  }

  /**
   * Get user
   * @param string $id
  */
  public static function get($id) {
    return Request::get("/online/v1/users/$id", array(
      "sign" => true
    ));
  }

  /**
   * Get users list
   * @param array $options
  */
  public static function all($options = array()) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return Request::get("/online/v1/users$queryString", array(
      "sign" => true
    ));
  }
}
