<?php

namespace Oderopay\Model\Webhook;

class RemoveStoredCard extends BaseWebhook
{

    public function getCardToken()
    {
        return $this->data['storedCardToken'] ?? null;
    }
}
