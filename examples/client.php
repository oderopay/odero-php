<?php
require_once "vendor/autoload.php";

$merchantId = '0e20885b-611a-4601-c648-08da5813b2f9';
$token = '5358f45a5d95bbf4eb669ed40e08c0ad';
//Authentication is already handled by SDK
$config = new \Oderopay\OderoConfig('My Store Name', $merchantId, $token, \Oderopay\OderoConfig::ENV_STG);

//Just initialize the Odero Client with given config.
$oderopay = new \Oderopay\OderoClient($config);
