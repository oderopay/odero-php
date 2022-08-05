<?php
require_once "client.php";

$payload = @file_get_contents('php://input');

try {

    $event = $oderopay->webhooks->handle(json_decode($payload, true));

    switch (true) {
        case $event instanceof \Oderopay\Model\Webhook\Payment:
            $paymentIntent = $event->getData();
            // Then define and call a method to handle the successful payment intent.
            // handlePaymentIntentSucceeded($paymentIntent);
            break;
        case $event instanceof \Oderopay\Model\Webhook\Refund:
            $paymentId = $event->getOperationId();

            // Then update your data
            break;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->getStatus(); //Should give ERROR
    }
}catch (InvalidArgumentException $exception){
    die($exception->getMessage());
}
