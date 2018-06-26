<?php
namespace SatispayOnline;

class Users {
  private $api;

  /**
   * Users constructor
   * @param Api $api Api
  */
  public function __construct($api) {
    $this->api = $api;
  }

  /**
   * Create user
   * @param array $body User body
  */
  public function create($body) {
    return $this->api->request->post("/online/v1/users", [
      "body" => $body,
      "sign" => true
    ]);
  }

  /**
   * Get user
   * @param string $id User id
  */
  public function get($id) {
    return $this->api->request->get("/online/v1/charges/$id", [
      "sign" => true
    ]);
  }
}
