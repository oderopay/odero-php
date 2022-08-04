<?php

namespace spec\Oderopay\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Oderopay\Http\HttpClient;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use PhpSpec\ObjectBehavior;

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

        $handlerStack = HandlerStack::create(new MockHandler($this->mockHandlerQueue));

        $client = new Client(['base_uri' => $oderoClient->config->getApiHost(), 'handler' => $handlerStack]);

        return new HttpClient($client);
    }

}