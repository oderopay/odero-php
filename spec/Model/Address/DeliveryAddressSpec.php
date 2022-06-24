<?php

namespace spec\Oderopay\Model\Address;

use Oderopay\Model\Address\Address;
use Oderopay\Model\Address\DeliveryAddress;
use PhpSpec\ObjectBehavior;

class DeliveryAddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DeliveryAddress::class);
        $this->shouldHaveType(Address::class);
    }

    public function it_should_create_address()
    {

        $this
            ->setAddress('address line')
            ->setCity('istanbul')
            ->setCountry('TUR')
            ->setDeliveryType('Courier')
        ;

        $this->getAddress()->shouldReturn('address line');
        $this->getCity()->shouldReturn('istanbul');
        $this->getCountry()->shouldReturn('TUR');
        $this->getDeliveryType()->shouldReturn('Courier');
    }
}
