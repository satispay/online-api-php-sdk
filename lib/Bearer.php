<?php
namespace Satispay;

use Satispay\Satispay;

class Bearer {
  public static function check() {
    $result = Satispay::request('/wally-services/protocol/authenticated');
    print_r($result);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 34:
          throw new \Exception('Not existing security Bearer');
          break;
        case 45:
          throw new \Exception('Authorization header not present');
          break;
      }
    }
    return $body;
  }
}
