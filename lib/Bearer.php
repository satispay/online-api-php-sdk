<?php
/*
Satispay Online API PHP SDK
Copyright (C) 2017  Satispay

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace SatispayOnline;

use SatispayOnline\Api;

class Bearer {
  public static function check() {
    $result = Api::request('/wally-services/protocol/authenticated');
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
