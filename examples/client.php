<?php
require_once "vendor/autoload.php";

$merchantId = '{merchant-id}'; //uuid
$token = '{merchant-token}';
//Authentication is already handled by SDK
$config = new \Oderopay\OderoConfig('My Store Name', $merchantId, $token, \Oderopay\OderoConfig::ENV_STG);

//Just initialize the Odero Client with given config.
$oderopay = new \Oderopay\OderoClient($config);
