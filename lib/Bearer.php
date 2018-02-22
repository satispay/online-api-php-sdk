<?php
namespace SatispayOnline;

use SatispayOnline\Api;

class Bearer {
  public static function check() {
    $result = Api::request('/wally-services/protocol/authenticated');
    return $result;
  }
}
