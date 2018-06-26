<?php
namespace SatispayOnline;

class Charges {
  private $api;

  /**
   * Charges constructor
   * @param Api $api Api
  */
  public function __construct($api) {
    $this->api = $api;
  }

  /**
   * Create charge
   * @param array $body Charge body
  */
  public function create($body) {
    return $this->api->request->post("/online/v1/charges", [
      "body" => $body,
      "sign" => true
    ]);
  }

  /**
   * Get charge
   * @param string $id Charge id
  */
  public function get($id) {
    return $this->api->request->get("/online/v1/charges/$id", [
      "sign" => true
    ]);
  }
}
