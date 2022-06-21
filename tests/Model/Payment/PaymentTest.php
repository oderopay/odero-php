<?php
declare(strict_types=1);

namespace Tests\Model\Payment;

use Oderopay\Model\Payment\Customer;
use Tests\OderoModelTest;

class PaymentTest extends OderoModelTest
{

    /**
     * @covers
     * @return void
     */
    public function test_should_create_payment_object()
    {
        $payment = $this->createPayment();

        $this->assertEquals('USD', $payment->getCurrency());
        $this->assertEquals(200, $payment->getAmount());
        $this->assertInstanceOf(Customer::class, $payment->getCustomer());
        $this->assertCount(1, $payment->getProducts());
        $this->assertCount(1, $payment->getSubMerchants());
        $this->assertCount(1, $payment->getSubMerchants());

    }

}
