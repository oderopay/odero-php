<?php

namespace spec\Oderopay\Service;

use Oderopay\Http\HttpClient;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpClient\MockHttpClient;

class BaseServiceSpec extends ObjectBehavior
{

    //stack of Response
    protected $mockHandlerQueue = [];

    public function getOderoClient(): OderoClient
    {
        $config = new OderoConfig('MY Store Name', 'merchantId', 'token');
        return new OderoClient($config);
    }

    public function getHttpClient(): HttpClient
    {
        $oderoClient = $this->getOderoClient();
		$client = new MockHttpClient($this->mockHandlerQueue);
        return new HttpClient($client);
    }

}