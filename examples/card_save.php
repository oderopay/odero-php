<?php
require_once "client.php";

$billingAddress = new \Oderopay\Model\Address\BillingAddress();
$billingAddress
    ->setAddress('185 Berry St #550, San Francisco, CA 94107, USA')
    ->setCity('San Francisco')
    ->setCountry('USA');

$deliveryAddress = new \Oderopay\Model\Address\DeliveryAddress();
$deliveryAddress
    ->setAddress('185 Berry St #550, San Francisco, CA 94107, USA')
    ->setCity('San Francisco')
    ->setCountry('USA')
    ->setDeliveryType('Courier');

$customer = new \Oderopay\Model\Payment\Customer();
$customer
    ->setEmail('customer@email.com')
    ->setPhoneNumber('	+40759969739')
    ->setDeliveryInformation($deliveryAddress)
    ->setBillingInformation($billingAddress);

$card = new \Oderopay\Model\Card\SaveCard();

$card->setCustomer($customer);
$card->setCurrency('RON');
$card->setReturnUrl('https://my-store.com/');

$cardResponse = $oderopay->cards->create($card);  //CardSaveResponse

if($cardResponse->isSuccess()){
    dump($cardResponse->toArray());
}else{
    echo $cardResponse->message;
}
