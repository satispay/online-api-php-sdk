<?php

require_once("../init.php");

\SatispayOnline\Api::setSandbox(true);

$authData = json_decode(file_get_contents("authentication.json"));

\SatispayOnline\Api::setSecurityBearer($authData->security_bearer);

$result = \SatispayOnline\Api::testAuthentication();

var_dump($result);
