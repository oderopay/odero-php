<?php
require_once __DIR__ . "/../vendor/autoload.php";

$merchantId = '1207ba5d-9c10-4849-bf71-31e306a95cda'; //uuid
$token = '9cc4b738f2161d83eb73e80bb3f55de9';


//$merchantId = '0e20885b-611a-4601-c648-08da5813b2f9'; //uuid
//$token = '5358f45a5d95bbf4eb669ed40e08c0ad';


$merchantId = '4bcdfbff-a547-4dad-984a-8490fb7741bf';
$token = '112cbc30a55096b5b92015b20077aea0';

//cornel bt 1 step
$merchantId = 'cde3307c-3cc0-485a-a08f-f8ff92b3e3f2';
$token = 'd04d29b59f9a69ab5e5eb8eadcbb4294';


//Authentication is already handled by SDK
$config = new \Oderopay\OderoConfig('My Store Name', $merchantId, $token, \Oderopay\OderoConfig::ENV_STG);

//Just initialize the Odero Client with given config.
$oderopay = new \Oderopay\OderoClient($config);
