<?php

namespace spec\Oderopay\Model\Address;

use Oderopay\Model\Address\Address;
use PhpSpec\ObjectBehavior;

class AddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Address::class);
    }
}
