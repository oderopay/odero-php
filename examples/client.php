<?php
require_once __DIR__ . "/../vendor/autoload.php";

$merchantId = '4bcdfbff-a547-4dad-984a-8490fb7741bf'; //uuid
$token = '112cbc30a55096b5b92015b20077aea0';

//dev
$merchantId = 'c303a4a7-a1e7-409b-bd78-4b8fef764f77'; //uuid
$token = 'd89eaf0d1787820c6e2fc55908ce4c9e';

//stg
$merchantId = '1e6bc3f5-85e6-40d1-bf0b-1ba7bcec8d67'; //uuid
$token = '73e6371920ade44516f5aa8b26b3d199';


//Authentication is already handled by SDK
$config = new \Oderopay\OderoConfig('My Store Name', $merchantId, $token, \Oderopay\OderoConfig::ENV_STG);

//Just initialize the Odero Client with given config.
$oderopay = new \Oderopay\OderoClient($config);
