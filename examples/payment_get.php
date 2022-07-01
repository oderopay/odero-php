<?php
require_once "client.php";

$payment = $oderopay->payments->get('2scEuPcRPMKc8fKkdWEFTz'); //PaymentIntentResponse

dd($payment);
if($payment->isSuccess()){
    dump($payment);
}else{
    echo $payment->message;
}
