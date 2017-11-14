<?php
/**
 * Satispay Online API PHP SDK
 * Copyright (C) 2017 Satispay <business@satispay.com>
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
 *
 *  @author    Satispay <business@satispay.com>
 *  @copyright 2017 Satispay <business@satispay.com>
 *  @license   http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace SatispayOnline;

use SatispayOnline\Api;

class Refund {
  public static function create($params = null) {
    $result = Api::request('/online/v1/refunds', 'POST', $params);
    return $result;
  }

  public static function all($params = null) {
    $queryString = '';
    if (!empty($params))
      $queryString = http_build_query($params);
    $result = Api::request('/online/v1/refunds?'.$queryString);
    return $result;
  }

  public static function get($id) {
    $result = Api::request('/online/v1/refunds/'.$id);
    return $result;
  }

  public static function update($id, $params = null) {
    $result = Api::request('/online/v1/refunds/'.$id, 'PUT', $params);
    return $result;
  }
}
