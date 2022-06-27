<?php
declare(strict_types=1);

namespace Tests\Service\Payment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Oderopay\Http\HttpClient;
use Oderopay\Http\Response\PaymentIntentResponse;
use Oderopay\Http\Response\PaymentResponse;
use Oderopay\Model\Payment\Payment;
use Oderopay\Service\Payment\PaymentService;
use Tests\Service\ServiceFactoryTest;

class PaymentServiceTest extends ServiceFactoryTest
{

    /**
     * @covers
     * @return void
     */
    public function test_creates_a_new_payment_request()
    {
        /** @var PaymentService $paymentService */
        $paymentService = $this->serviceFactory->__get('payments');

        $this->assertInstanceOf(PaymentService::class, $paymentService);

        $paymentSuccessStub = file_get_contents(__DIR__ . "/../../../stubs/payment/success.json");
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], $paymentSuccessStub),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['base_uri' => $this->config->getApiHost(), 'handler' => $handlerStack]);
        $paymentService->http = new HttpClient($client);

        //test the actual response
        $response =  $paymentService->create(new Payment());

        $this->assertInstanceOf(PaymentIntentResponse::class, $response);
        $this->assertSame('uuid', $response->requestId);
        $this->assertSame('string', $response->message);
        $this->assertArrayHasKey('paymentId', $response->data);
        $this->assertSame($paymentSuccessStub, $response->getContents());
        $this->assertSame(json_decode($paymentSuccessStub, true), $response->toArray());

    }


    /**
     * @covers
     * @return void
     */
    public function test_get_single_payment_object()
    {
        /** @var PaymentService $paymentService */
        $paymentService = $this->serviceFactory->__get('payments');

        $singlePaymentSuccess = file_get_contents(__DIR__ . "/../../../stubs/payment/single_payment.json");
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], $singlePaymentSuccess),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['base_uri' => $this->config->getApiHost(), 'handler' => $handlerStack]);
        $paymentService->http = new HttpClient($client);

        $response = $paymentService->get('uuid');

        $this->assertInstanceOf(PaymentResponse::class, $response);
        $this->assertSame($singlePaymentSuccess, $response->getContents());
        $this->assertSame('uuid', $response->merchantId);
        $this->assertSame('uuid', $response->paymentId);
        $this->assertSame('string', $response->currency);
        $this->assertSame('one_time', $response->type);
        $this->assertSame(false, $response->recurring);

        $this->assertSame(json_decode($singlePaymentSuccess, true), $response->toArray());

    }
}
