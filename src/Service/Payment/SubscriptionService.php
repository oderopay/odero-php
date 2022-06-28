<?php

namespace Oderopay\Service\Payment;

use Oderopay\Model\Payment\Payment;

class SubscriptionService extends PaymentService
{
    public function create(Payment $payment)
    {
        $payment->setRecurring(true);

        //check subscription
        if(!$payment->getSubscription()){
            throw new \InvalidArgumentException('Subscription not found in payment');
        }

        return parent::create($payment);
    }
}
