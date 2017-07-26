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

class Refund {
  public static function create($params = null) {
    $result = Api::request('/online/v1/refunds', 'POST', $params);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 36:
          throw new \Exception('Body validation error');
          break;
        case 45:
          throw new \Exception('Try to create a refund for a Charge not owned by user');
          break;
        case 52:
          throw new \Exception('Beneficiary validation');
          break;
      }
    }
    return $body;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/refunds?'.$queryString);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 45:
          throw new \Exception('Try to get a refund of another shop');
          break;
        case 52:
          throw new \Exception('Beneficiary validation');
          break;
      }
    }
    return $body;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/refunds/'.$id);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 41:
          throw new \Exception('Refund does not exist');
          break;
        case 45:
          throw new \Exception('Try to get a refund of another shop');
          break;
        case 52:
          throw new \Exception('Shop validation error');
          break;
      }
    }
    return $body;
  }

  public static function update($id, $params = null) {
    $result = Api::request('/online/v1/refunds/'.$id, 'PUT', $params);
    $body = $result['body'];
    if (!empty($body->code)) {
      switch($body->code) {
        case 45:
          throw new \Exception('Try to update a refund of another user');
          break;
        case 52:
          throw new \Exception('Beneficiary validation');
          break;
        case 36:
          throw new \Exception('Body validation error');
          break;
        case 41:
          throw new \Exception('Refund don’t exist');
          break;
      }
    }
    return $body;
  }
}
