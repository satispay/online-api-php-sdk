<?php
namespace SatispayOnline;

class Checkouts {
  private $api;

  /**
   * Checkouts constructor
   * @param Api $api Api
  */
  public function __construct($api) {
    $this->api = $api;
  }

  /**
   * Create checkout
   * @param array $body Checkout body
  */
  public function create($body) {
    return $this->api->request->post("/online/v1/checkouts", [
      "body" => $body,
      "sign" => true
    ]);
  }
}
