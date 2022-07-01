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
        $body = ['form_params' => ['merchantId' => $this->client->config->getMerchantId()]];

        $response = $this->request('POST','api/payments/' . $paymentId . '/recurring/retry', $body);

        return new PaymentResponse($response);
    }

    /**
     * @param $paymentId
     * @return PaymentResponse
     */
    public function cancel($paymentId): PaymentResponse
    {
        $body = ['form_params' => ['merchantId' => $this->client->config->getMerchantId()]];

        $response = $this->request('POST','api/payments/' . $paymentId . '/recurring/cancel', $body);

        return new PaymentResponse($response);
    }
}
