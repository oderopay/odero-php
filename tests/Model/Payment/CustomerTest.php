<?php
declare(strict_types=1);

namespace Tests\Model\Payment;

use Oderopay\Model\Address\BillingAddress;
use Oderopay\Model\Address\DeliveryAddress;
use Oderopay\Model\Payment\Customer;
use Tests\OderoModelTest;
use Tests\OderoTestCase;

class CustomerTest extends OderoModelTest
{

    /**
     * @covers
     * @return void
     */
    public function testCusomerObject()
    {
        $customer = $this->createCustomer();

        $this->assertInstanceOf(BillingAddress::class, $customer->getBillingInformation());
        $this->assertSame('TUR', $customer->getBillingInformation()->getCountry());
        $this->assertSame('istanbul', $customer->getBillingInformation()->getCity());

        $this->assertInstanceOf(DeliveryAddress::class, $customer->getDeliveryInformation());
        $this->assertSame('TUR', $customer->getDeliveryInformation()->getCountry());
        $this->assertSame('istanbul', $customer->getDeliveryInformation()->getCity());
        $this->assertSame('courier', $customer->getDeliveryInformation()->getDeliveryType());

        $arrayOutput = [
            "email" => "test@test.com",
            "phoneNumber" => "123123123",
            "deliveryInformation" => [
                "deliveryType" => "courier",
                "country" => "TUR",
                "city" => "istanbul",
                "address" => "open address"
            ],
            "billingInformation" => [
            "country" => "TUR",
            "city" => "istanbul",
            "address" => "address line"
            ]
        ];

        $this->assertSame($arrayOutput, $customer->toArray());

    }
}
