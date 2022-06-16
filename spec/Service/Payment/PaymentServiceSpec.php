<?php

namespace spec\Oderopay\Service\Payment;

use Oderopay\Model\Payment\Payment;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use PhpSpec\ObjectBehavior;

class PaymentServiceSpec extends ObjectBehavior
{
    function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantıd', 'token');
        $oderoClient = new OderoClient($config);
        $this->beConstructedWith($oderoClient);
    }

    public function it_should_have_create_method(Payment $payment)
    {
        $this->create($payment)->shouldReturn($payment);
    }
}
