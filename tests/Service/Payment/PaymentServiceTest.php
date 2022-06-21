<?php
declare(strict_types=1);

namespace Tests\Service\Payment;

use Oderopay\Http\HttpClient;
use Oderopay\Model\Payment\Payment;
use Oderopay\Service\Payment\PaymentService;
use Tests\Service\ServiceFactoryTest;

class PaymentServiceTest extends ServiceFactoryTest
{

    /**
     * @covers
     * @return void
     */
    public function test_makes_http_post_call()
    {
        /** @var PaymentService $paymentService */
        $paymentService = $this->serviceFactory->__get('payments');
        $paymentService->http = $this->http;

        $response =  $paymentService->create(new Payment());

        $stub = file_get_contents(__DIR__ . "/../../../stubs/payment/success.json");
        $this->assertSame($stub, $response);

        $this->assertInstanceOf(PaymentService::class, $paymentService);
    }
}
