<?php
require_once "client.php";

$subscription = $oderopay->subscriptions->retry('4ofmJJzNoW5j2kBmu7DyAm'); //PaymentIntentResponse

dd($subscription);
if($subscription->isSuccess()){
    dump($subscription);
    //redirect to $subscription->data['url'];
}else{
    dump($subscription);
}
