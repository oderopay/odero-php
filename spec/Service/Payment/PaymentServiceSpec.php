<?php

namespace spec\Oderopay\Service\Payment;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Oderopay\Http\Response\PaymentIntentResponse;
use Oderopay\Model\Payment\Payment;
use Oderopay\OderoClient;
use Oderopay\Service\BaseService;
use spec\Oderopay\Service\BaseServiceSpec;

class PaymentServiceSpec extends BaseServiceSpec
{
    function let()
    {
        $paymentSuccess = file_get_contents(OderoClient::APP_DIR . "/stubs/payment/success.json");
        // Create a mock and queue two responses.
        $this->mockHandlerQueue = [
            new Response(200, [], $paymentSuccess),
            new Response(400, []),
            new Response(403, []),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ];

        $this->beConstructedWith($this->getOderoClient(), $this->getHttpClient());
        $this->shouldBeAnInstanceOf(BaseService::class);

    }

    public function it_should_have_create_payment_request()
    {
        $payment = new Payment();

        $payment = $this->create($payment);
        $payment->shouldReturnAnInstanceOf(PaymentIntentResponse::class);
        $payment->getCode()->shouldReturn(200);
        $payment->getMessage()->shouldReturn('string');
        $payment->getOperationId()->shouldReturn('uuid');
        $payment->toArray()->shouldBeArray();

    }

}
