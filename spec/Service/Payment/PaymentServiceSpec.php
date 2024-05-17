<?php

namespace spec\Oderopay\Service\Payment;

use Oderopay\Service\BaseService;
use spec\Oderopay\Service\BaseServiceSpec as BaseServiceSp;
use Oderopay\Http\Response\PaymentIntentResponse;
use Oderopay\Model\Payment\Payment;
use Oderopay\OderoClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PaymentServiceSpec extends BaseServiceSp
{
    function let()
    {
        $paymentSuccess = file_get_contents(OderoClient::APP_DIR . "/stubs/payment/success.json");
        // Create a mock and queue two responses.

		$this->mockHandlerQueue = [
			new MockResponse($paymentSuccess),
			new MockResponse([], ['http_code' => 400]),
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
