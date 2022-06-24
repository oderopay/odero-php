<?php

namespace spec\Oderopay\Model\Address;

use Oderopay\Model\Address\Address;
use Oderopay\Model\Address\BillingAddress;
use PhpSpec\ObjectBehavior;

class BillingAddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BillingAddress::class);
        $this->shouldHaveType(Address::class);
    }

    public function it_should_create_address()
    {

        $this
            ->setAddress('address line')
            ->setCity('istanbul')
            ->setCountry('TUR')
        ;

        $this->getAddress()->shouldReturn('address line');
        $this->getCity()->shouldReturn('istanbul');
        $this->getCountry()->shouldReturn('TUR');
    }
}
