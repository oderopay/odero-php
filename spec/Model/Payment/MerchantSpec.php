<?php

namespace spec\Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Payment\Merchant;
use PhpSpec\ObjectBehavior;
use spec\Oderopay\Model\OderoModelSpec;

class MerchantSpec extends OderoModelSpec
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Merchant::class);
        $this->shouldHaveType(AbstractRequest::class);
    }

    function it_should_create_merchant()
    {

        $this
            ->setName('Test Merchant')
            ->setExtId('123123')
            ->setCommission(0.1)
            ->addProduct($this->createBasketItem());

        $this->getProducts()->shouldBeArray();

        $this->getName()->shouldReturn('Test Merchant');
        $this->getCommission()->shouldReturn(0.1);

        $firstProduct = $this->getProducts()[0];

        $firstProduct->getQuantity()->shouldReturn(2);
        $firstProduct->getPrice()->shouldReturn(100);
        $firstProduct->getTotal()->shouldReturn(200);

    }
}
