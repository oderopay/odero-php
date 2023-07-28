<?php

namespace Oderopay\Service\Payment;

use Oderopay\Http\Response\PaymentIntentResponse;
use Oderopay\Http\Response\PaymentResponse;
use Oderopay\Model\Payment\BasketItem;
use Oderopay\Model\Payment\Merchant;
use Oderopay\Model\Payment\Payment;
use Oderopay\Model\Payment\PaymentLink;
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
            $merchant->setAmount($payment->getAmount());
            $merchant->setName($this->client->config->getName());
            $merchant->setExtId($this->client->config->getMerchantId());
            $merchant->setCommission(0);
            $merchant->setProducts($payment->getProducts());
            $payment->setSubMerchants([$merchant]);
        }

        if(!$payment->getAmount()){
            $payment->setAmount($total ?? 0);
        }

        $uri = 'api/payments/one-time';
        if($payment->getCardToken()){
            $uri = 'api/payments/stored-card';
        }

        if($payment instanceof PaymentLink){
            $uri = 'api/payments/link';
        }

        $payload = $payment->toArray(); unset($payload['products']);

        $response = $this->request('POST', $uri, ['form_params' => $payload]);

        return new PaymentIntentResponse($response);

    }

    /**
     * @param string $uuid
     * @return PaymentResponse
     */
    public function get(string $uuid): PaymentResponse
    {
        $response = $this->request('GET','api/payments/' . $uuid);

        return new PaymentResponse($response);
    }
}

