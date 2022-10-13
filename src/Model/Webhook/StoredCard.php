<?php

namespace Oderopay\Model\Webhook;

class StoredCard extends BaseWebhook
{

    /**
     * @return mixed|null
     */
    public function getCardToken()
    {
        return $this->data['cardToken'] ?? null;
    }


    /**
     * @return mixed|null
     */
    public function getLastFourDigits()
    {
        return $this->data['lastFourDigits'] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getExpirationMonth()
    {
        return $this->data['expirationMonth'] ?? null;
    }


    /**
     * @return mixed|null
     */
    public function getExpirationYear()
    {
        return $this->data['expirationYear'] ?? null;
    }

}
