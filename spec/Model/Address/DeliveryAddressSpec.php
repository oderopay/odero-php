<?php

namespace spec\Oderopay\Model\Address;

use Oderopay\Model\Address\DeliveryAddress;
use PhpSpec\ObjectBehavior;

class DeliveryAddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DeliveryAddress::class);
    }
}
