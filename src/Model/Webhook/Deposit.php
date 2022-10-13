<?php

namespace Oderopay\Model\Webhook;

class Deposit extends BaseWebhook
{

    /**
     * @return mixed|null
     */
    public function getPaymentId()
    {
        return $this->data['paymentId'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getPaymentOperationId()
    {
        return $this->data['paymentOperationId'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getAmount()
    {
        return $this->data['amount'] ?? null;
    }

}
