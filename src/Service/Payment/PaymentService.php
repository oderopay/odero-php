<?php

namespace Oderopay\Service\Payment;

use Oderopay\Http\Response\PaymentIntentResponse;
use Oderopay\Http\Response\PaymentResponse;
use Oderopay\Model\Payment\BasketItem;
use Oderopay\Model\Payment\Merchant;
use Oderopay\Model\Payment\Payment;
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

        $total = array_reduce($payment->getProducts(), function($sum, $product){
            /** @var BasketItem $product */
            $sum += $product->getTotal();
            return $sum;
        });

        if(empty($payment->getSubMerchants())){
            $merchant = new Merchant();
            $merchant->setAmount($total);
            $merchant->setName($this->client->config->getName());
            $merchant->setExtId($this->client->config->getMerchantId());
            $merchant->setCommission(0);
            $merchant->setProducts($payment->getProducts());
            $payment->setSubMerchants([$merchant]);
        }

        if(!$payment->getAmount()){
            $payment->setAmount($total ?? 0);
        }

        $response = $this->request('POST','/api/payments/one-time', ['form_params' => $payment->toArray()]);

        return new PaymentIntentResponse($response);

    }

    /**
     * @param string $uuid
     * @return PaymentResponse
     */
    public function get(string $uuid): PaymentResponse
    {
        $response = $this->request('GET','/api/payments/' . $uuid);

        return new PaymentResponse($response);
    }
}

