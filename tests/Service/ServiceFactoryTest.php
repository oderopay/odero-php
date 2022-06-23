<?php
declare(strict_types=1);

namespace Tests\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Oderopay\Http\HttpClient;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use Oderopay\Service\Payment\PaymentService;
use Oderopay\Service\ServiceFactory;
use Tests\OderoTestCase;

class ServiceFactoryTest extends OderoTestCase
{
    protected function setUp() :void
    {
        $config = new OderoConfig('My Store Name', 'merchantId', 'token');
        $oderoClient = new OderoClient($config);

        $this->serviceFactory = new ServiceFactory($oderoClient);

        $this->config = $config;

        parent::setUp();
    }

    /**
     * @covers
     * @return void
     */
    public function test_it_should_have_payments_service()
    {
        $this->assertInstanceOf(PaymentService::class, $this->serviceFactory->__get('payments'));
    }
}
