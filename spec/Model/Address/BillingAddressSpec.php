<?php

namespace spec\Oderopay\Model\Address;

use Oderopay\Model\Address\BillingAddress;
use PhpSpec\ObjectBehavior;

class BillingAddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BillingAddress::class);
    }
}
