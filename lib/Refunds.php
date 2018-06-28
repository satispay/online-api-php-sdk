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
      "body" => $body
    ]);
  }

  /**
   * Get refund
   * @param string $id Refund id
  */
  public function get($id) {
    return $this->api->request->get("/online/v1/refunds/$id");
  }

  /**
   * Get refunds list
   * @param array $options Options
  */
  public function all($options = []) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return $this->api->request->get("/online/v1/refunds$queryString");
  }

  /**
   * Update refund
   * @param string $id Refund id
   * @param array $body Refund body
  */
  public function update($id, $body) {
    return $this->api->request->put("/online/v1/refunds", [
      "body" => $body
    ]);
  }
}
