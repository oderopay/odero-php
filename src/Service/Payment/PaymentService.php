<?php

namespace Oderopay\Service\Payment;

use Oderopay\Model\Payment\Merchant;
use Oderopay\Model\Payment\Payment;
use Oderopay\Service\BaseService;

class PaymentService extends BaseService
{
    public function create(Payment $payment)
    {
        if(empty($payment->getSubMerchants())){
            $merchant = new Merchant();
            $merchant->setAmount(1); // total amount of products
            $merchant->setName($this->client->config->getName());
            $merchant->setExtId($this->client->config->getMerchantId());
            $merchant->setCommission(0);
            $merchant->setProducts($payment->getProducts());
        }

        return $payment;
    }
}
