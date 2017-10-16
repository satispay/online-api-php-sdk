<?php
/** 
 * Satispay Online API PHP SDK
 * Copyright (C) 2017  Satispay
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SatispayOnline;

use SatispayOnline\Api;

class User {
  public static function create($params = null) {
    $result = Api::request('/online/v1/users', 'POST', $params);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 52:
          throw new \Exception('Shop validation error');
          break;
        case 36:
          throw new \Exception('Phone number required');
          break;
        case 39:
          throw new \Exception('Invalid phone number');
          break;
        case 49:
          throw new \Exception('The phone number isn’t from a registered user');
          break;
      }
    }
    return $body;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/users?'.$queryString);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 52:
          throw new \Exception('Beneficiary validation error');
          break;
      }
    }
    return $body;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/users/'.$id);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 41:
          throw new \Exception('UserShop don’t exist');
          break;
      }
    }
    return $body;
  }
}
