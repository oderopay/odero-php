<?php
require_once "client.php";

$payment = $oderopay->payments->get('245cc97d-de9b-4f8c-b1c8-05081e5f3327'); //PaymentIntentResponse

dd($payment);
if($payment->isSuccess()){
    dump($payment);
}else{
    echo $payment->message;
}
