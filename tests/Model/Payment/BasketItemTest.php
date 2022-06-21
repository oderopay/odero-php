<?php
declare(strict_types=1);

namespace Tests\Model\Payment;

use Tests\OderoModelTest;

class BasketItemTest extends OderoModelTest
{
    /**
     * @covers
     * @return void
     */
    public function test_basket_item()
    {
        $product = $this->createBasketItem();

        $this->assertSame(200, $product->getTotal());

        $arrayOutput =  [
            "extId" => "123",
            "price" => 100,
            "quantity" => 2,
            "total" => 200,
            "name" => "Product 1",
            "imageUrl" => null,
        ];

        $this->assertSame($arrayOutput, $product->toArray());
    }
}
