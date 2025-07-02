<?php
require_once "client.php";

$paymentRequest = new \Oderopay\Model\Payment\PaymentLink();
$paymentRequest
    ->setItemDescription('Sample Product')
    ->setCurrency('RON')
    ->setAmount(0.2)
	->setDescription('payment description')
    ->setExpireAt((new DateTime())->add(new DateInterval("P1Y")))
;

try {
    $payment = $oderopay->payments->create($paymentRequest); //PaymentIntentResponse
    var_dump($payment);
}catch (\Exception $e){
    echo $e->getMessage();
}
