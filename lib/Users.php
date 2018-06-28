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
      "body" => $body
    ]);
  }

  /**
   * Get user
   * @param string $id User id
  */
  public function get($id) {
    return $this->api->request->get("/online/v1/users/$id");
  }

  /**
   * Get users list
   * @param array $options Options
  */
  public function all($options = []) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return $this->api->request->get("/online/v1/users$queryString");
  }
}
