<?php

namespace spec\Oderopay\Service;

use Oderopay\OderoClient;
use Oderopay\OderoClientInterface;
use Oderopay\OderoConfig;
use Oderopay\Service\AbstractServiceFactory;
use Oderopay\Service\Payment\PaymentService;
use PhpSpec\ObjectBehavior;

class ServiceFactorySpec extends ObjectBehavior
{
    function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantıd', 'token');
        $oderoClient = new OderoClient($config);
        $this->beConstructedWith($oderoClient);
        $this->shouldBeAnInstanceOf(AbstractServiceFactory::class);

    }

    function it_should_have_odero_client()
    {
        $this->getClient()->shouldBeAnInstanceOf(OderoClientInterface::class);
    }

    function it_should_have_service_class(){
        $this->getServiceClass('payments')->shouldBe(PaymentService::class);
    }
}
