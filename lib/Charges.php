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
      "body" => $body
    ]);
  }

  /**
   * Get charge
   * @param string $id Charge id
  */
  public function get($id) {
    return $this->api->request->get("/online/v1/charges/$id");
  }

  /**
   * Get charges list
   * @param array $options Options
  */
  public function all($options = []) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return $this->api->request->get("/online/v1/charges$queryString");
  }

  /**
   * Update charge
   * @param string $id Charge id
   * @param array $body Charge body
  */
  public function update($id, $body) {
    return $this->api->request->put("/online/v1/charges", [
      "body" => $body
    ]);
  }
}
