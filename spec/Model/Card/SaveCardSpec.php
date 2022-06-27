<?php

namespace spec\Oderopay\Model\Card;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Card\SaveCard;
use PhpSpec\ObjectBehavior;

class SaveCardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SaveCard::class);
        $this->shouldHaveType(AbstractRequest::class);
    }
}
