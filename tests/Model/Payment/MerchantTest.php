<?php
declare(strict_types=1);

namespace Tests\Model\Payment;

use Tests\OderoModelTest;

class MerchantTest extends OderoModelTest
{

    /**
     * @covers
     * @return void
     */
    public function test_it_creates_merchant()
    {
        $merchant = $this->createMerchant();

        $this->assertSame('Test Merchant', $merchant->getName());
        $this->assertSame('123123', $merchant->getExtId());
        $this->assertSame(200, $merchant->getAmount());

    }

    /**
     * @covers
     * @return void
     */
    public function test_it_removes_product()
    {
        $merchant = $this->createMerchant();
        $product = $this->createBasketItem();

        $merchant->removeProduct($product);

        $this->assertEmpty($merchant->getProducts());
    }
}
