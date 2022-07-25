<?php

namespace spec\Oderopay\Service\Payment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Oderopay\Http\HttpClient;
use Oderopay\Http\Response\PaymentIntentResponse;
use Oderopay\Model\Payment\Payment;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use Oderopay\Service\BaseService;
use PhpSpec\ObjectBehavior;

class PaymentServiceSpec extends ObjectBehavior
{
    function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantId', 'token');
        $oderoClient = new OderoClient($config);

        $paymentSuccess = file_get_contents(OderoClient::APP_DIR . "/stubs/payment/success.json");

        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], $paymentSuccess),
            new Response(400, []),
            new Response(403, []),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['base_uri' => $config->getApiHost(), 'handler' => $handlerStack]);
        $http = new HttpClient($client);

        $this->beConstructedWith($oderoClient, $http);
        $this->shouldBeAnInstanceOf(BaseService::class);

    }

    public function it_should_have_create_payment_request()
    {
        $payment = new Payment();
        $stub = file_get_contents(OderoClient::APP_DIR . "/stubs/payment/success.json");

        $payment = $this->create($payment);
        $payment->shouldReturnAnInstanceOf(PaymentIntentResponse::class);
        $payment->getCode()->shouldReturn(200);
        $output = json_decode($stub, true);

        $payment->toArray()->shouldReturn($output);

    }

}
