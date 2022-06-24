<?php

namespace spec\Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Payment\BasketItem;
use PhpSpec\ObjectBehavior;
use spec\Oderopay\Model\OderoModelSpec;

class BasketItemSpec extends OderoModelSpec
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BasketItem::class);
        $this->shouldHaveType(AbstractRequest::class);
    }

    function it_creates_basket_item()
    {
        $this
            ->setExtId('123')
            ->setName('Product 1')
            ->setPrice(100)
            ->setQuantity(2)
        ;

        $this->getTotal()->shouldReturn(200);

        $arrayOutput =  [
            "extId" => "123",
            "price" => 100,
            "quantity" => 2,
            "total" => 200,
            "name" => "Product 1",
        ];

        $this->toArray()->shouldReturn($arrayOutput);
    }
}
