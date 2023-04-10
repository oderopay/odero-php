<?php
require_once __DIR__ . "/../vendor/autoload.php";

$merchantId = '4bcdfbff-a547-4dad-984a-8490fb7741bf'; //uuid
$token = '112cbc30a55096b5b92015b20077aea0';


//Authentication is already handled by SDK
$config = new \Oderopay\OderoConfig('My Store Name', $merchantId, $token, \Oderopay\OderoConfig::ENV_STG);

//Just initialize the Odero Client with given config.
$oderopay = new \Oderopay\OderoClient($config);
