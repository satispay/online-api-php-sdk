<?php
namespace SatispayOnline;

class Charges {
  private $api;

  public function __construct($api) {
    $this->api = $api;
  }
}
