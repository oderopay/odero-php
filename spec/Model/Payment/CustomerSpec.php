<?php

namespace spec\Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Address\BillingAddress;
use Oderopay\Model\Address\DeliveryAddress;
use Oderopay\Model\Payment\Customer;
use PhpSpec\ObjectBehavior;
use spec\Oderopay\Model\OderoModelSpec;

class CustomerSpec extends OderoModelSpec
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Customer::class);
        $this->shouldHaveType(AbstractRequest::class);
    }

    function it_should_create_customer()
    {
        $this
            ->setEmail('test@test.com')
            ->setPhoneNumber('123123123')
        ;

        //billing address
        $billingAddress = $this->createBillingAddress();
        $this->setBillingInformation($billingAddress);

        //delivery address
        $deliveryAddress = $this->createDeliveryAddress();
        $this->setDeliveryInformation($deliveryAddress);

        $this->getEmail()->shouldReturn('test@test.com');
        $this->getPhoneNumber()->shouldReturn('123123123');
        $this->getDeliveryInformation()->shouldReturnAnInstanceOf(DeliveryAddress::class);
        $this->getBillingInformation()->shouldReturnAnInstanceOf(BillingAddress::class);
        $this->getDeliveryInformation()->getCity()->shouldReturn('istanbul');
        $this->getDeliveryInformation()->getCountry()->shouldReturn('TUR');
        $this->getDeliveryInformation()->getDeliveryType()->shouldReturn('courier');
        $this->getDeliveryInformation()->getAddress()->shouldReturn('open address');

        $this->getBillingInformation()->getCity()->shouldReturn('istanbul');
        $this->getBillingInformation()->getCountry()->shouldReturn('TUR');
        $this->getBillingInformation()->getAddress()->shouldReturn('address line');
    }
}
