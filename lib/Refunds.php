<?php
namespace SatispayOnline;

class Refunds {
  private $api;

  /**
   * Refunds constructor
   * @param Api $api Api
  */
  public function __construct($api) {
    $this->api = $api;
  }

  /**
   * Create refund
   * @param array $body Refund body
  */
  public function create($body) {
    return $this->api->request->post("/online/v1/refunds", [
      "body" => $body,
      "sign" => true
    ]);
  }

  /**
   * Get refund
   * @param string $id Refund id
  */
  public function get($id) {
    return $this->api->request->get("/online/v1/refunds/$id", [
      "sign" => true
    ]);
  }
}
