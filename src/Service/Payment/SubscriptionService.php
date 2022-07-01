<?php

namespace Oderopay\Service\Payment;

use Oderopay\Http\Response\PaymentResponse;
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

    /**
     * @param $paymentId
     * @return PaymentResponse
     */
    public function retry($paymentId): PaymentResponse
    {
        $response = $this->request('GET','api/payments/' . $paymentId . '/recurring/retry');

        return new PaymentResponse($response);
    }

    /**
     * @param $paymentId
     * @return PaymentResponse
     */
    public function cancel($paymentId): PaymentResponse
    {
        $response = $this->request('GET','api/payments/' . $paymentId . '/recurring/cancel');

        return new PaymentResponse($response);
    }
}
