<?php
require_once "client.php";

$subscription = $oderopay->subscriptions->cancel('4ofmH6EmWii9t7Gsdw1UHb'); //PaymentIntentResponse

dump($subscription); //PaymentResponse
