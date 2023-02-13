<?php
require_once __DIR__ . "/../vendor/autoload.php";

$merchantId = '1207ba5d-9c10-4849-bf71-31e306a95cda'; //uuid
$token = '9cc4b738f2161d83eb73e80bb3f55de9';


//Authentication is already handled by SDK
$config = new \Oderopay\OderoConfig('My Store Name', $merchantId, $token, \Oderopay\OderoConfig::ENV_STG);

//Just initialize the Odero Client with given config.
$oderopay = new \Oderopay\OderoClient($config);
