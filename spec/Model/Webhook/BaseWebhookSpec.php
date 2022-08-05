<?php

namespace spec\Oderopay\Model\Webhook;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Webhook\BaseWebhook;
use PhpSpec\ObjectBehavior;

class BaseWebhookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BaseWebhook::class);
        $this->shouldHaveType(AbstractRequest::class);
    }
}
