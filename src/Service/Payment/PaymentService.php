<?php

namespace Oderopay\Service\Payment;

use Oderopay\Model\Payment\Merchant;
use Oderopay\Model\Payment\Payment;
use Oderopay\Response\PaymentIntentResponse;
use Oderopay\Response\PaymentResponse;
use Oderopay\Service\BaseService;

class PaymentService extends BaseService
{
    /**
     * @param Payment $payment
     * @return PaymentIntentResponse
     */
    public function create(Payment $payment)
    {
        $payment->setMerchantId($this->client->config->getMerchantId());

        if(empty($payment->getSubMerchants())){
            $merchant = new Merchant();
            $merchant->setAmount(1); // total amount of products
            $merchant->setName($this->client->config->getName());
            $merchant->setExtId($this->client->config->getMerchantId());
            $merchant->setCommission(0);
            $merchant->setProducts($payment->getProducts());
        }

        $response = $this->request('POST','/api/payments/one-time', ['form_params' => $payment->toArray()]);

        return new PaymentIntentResponse($response);

    }

    /**
     * @param string $uuid
     * @return PaymentResponse
     */
    public function get(string $uuid)
    {
        $response = $this->request('GET','/api/payments/' . $uuid);

        return new PaymentResponse($response);
    }
}

