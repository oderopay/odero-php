<?php

namespace spec\Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Payment\Customer;
use Oderopay\Model\Payment\Payment;
use PhpSpec\ObjectBehavior;
use spec\Oderopay\Model\OderoModelSpec;

class PaymentSpec extends OderoModelSpec
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Payment::class);
        $this->shouldHaveType(AbstractRequest::class);
    }

    public function it_should_create_payment_object()
    {
        $products[] = $this->createBasketItem();
        $merchants[] = $this->createMerchant();

        $this
            ->setAmount(200)
            ->setProducts($products)
            ->setCustomer($this->createCustomer())
            ->setCurrency('USD')
            ->setExtOrderId("123123123")
            ->setExtOrderUrl("https//google.com")
            ->setSubMerchants($merchants)
        ;

        $this->getCurrency()->shouldReturn('USD');
        $this->getAmount()->shouldReturn(200.0);
        $this->getCustomer()->shouldBeAnInstanceOf(Customer::class);
        $this->getProducts()->shouldBeArray();
        $this->getProducts()->shouldHaveCount(1);

        $this->getSubMerchants()->shouldBeArray();
        $this->getSubMerchants()->shouldHaveCount(1);

    }
}
