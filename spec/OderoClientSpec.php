<?php

namespace spec\Oderopay;

use Oderopay\OderoClientInterface;
use Oderopay\OderoConfig;
use PhpSpec\ObjectBehavior;

class OderoClientSpec extends ObjectBehavior
{
    function it_is_initializable(OderoConfig $config)
    {
        $this->beConstructedWith($config);
        $this->shouldBeAnInstanceOf(OderoClientInterface::class);
    }

}
