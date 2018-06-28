<?php
namespace SatispayOnline;

class Amounts {
  private $api;

  /**
   * Amounts constructor
   * @param Api $api Api
  */
  public function __construct($api) {
    $this->api = $api;
  }

  /**
   * Get amounts
   * @param array $options Options
  */
  public function get($options = []) {
    $queryString = "";
    if (!empty($options)) {
      $queryString .= "?";
      $queryString .= http_build_query($options);
    }
    return $this->api->request->get("/online/v1/amounts$queryString");
  }
}
