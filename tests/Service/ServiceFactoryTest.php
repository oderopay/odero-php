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

        $paymentSuccess = file_get_contents(__DIR__ . "/../../stubs/payment/success.json");


        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], $paymentSuccess),
            new Response(400, []),
            new Response(403, []),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['base_uri' => $config->getApiHost(), 'handler' => $handlerStack]);
        $this->http = new HttpClient($client);

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
