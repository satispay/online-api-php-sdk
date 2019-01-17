<?php
namespace SatispayOnline;

class Checkout {
  /**
   * Create checkout
   * @param array $body Checkout body
  */
  public static function create($body) {
    return Request::post("/online/v1/checkouts", array(
      "body" => $body,
      "sign" => true
    ));
  }
}
