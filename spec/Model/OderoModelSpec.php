<?php
declare(strict_types=1);

namespace spec\Oderopay\Model;

use Oderopay\Model\Address\BillingAddress;
use Oderopay\Model\Address\DeliveryAddress;
use Oderopay\Model\Payment\BasketItem;
use Oderopay\Model\Payment\Customer;
use Oderopay\Model\Payment\Merchant;
use Oderopay\Model\Payment\Payment;
use PhpSpec\ObjectBehavior;

class OderoModelSpec extends ObjectBehavior
{

    /**
     * @group ignore
     */
    public function createBasketItem() : BasketItem
    {
        $product = new BasketItem();

        $product
            ->setExtId('123')
            ->setName('Product 1')
            ->setPrice(100)
            ->setQuantity(2)
        ;

        return $product;

    }

    /**
     * @group ignore
     */
    public function createBillingAddress() : BillingAddress
    {
        $billingAddress = new BillingAddress();
        $billingAddress
            ->setAddress('address line')
            ->setCity('istanbul')
            ->setCountry('TUR')
        ;

        return $billingAddress;
    }

    /**
     * @group ignore
     */
    public function createDeliveryAddress() : DeliveryAddress
    {
        $deliveryAddress = new DeliveryAddress();
        $deliveryAddress
            ->setCountry('TUR')
            ->setCity('istanbul')
            ->setAddress('open address')
            ->setDeliveryType('courier')
        ;
        return $deliveryAddress;
    }

    /**
     * @group ignore
     */
    public function createCustomer() : Customer
    {
        $customer = new Customer();

        $customer
            ->setEmail('test@test.com')
            ->setPhoneNumber('123123123')
        ;

        //billing address
        $billingAddress = $this->createBillingAddress();
        $customer->setBillingInformation($billingAddress);

        //delivery address
        $deliveryAddress = $this->createDeliveryAddress();
        $customer->setDeliveryInformation($deliveryAddress);

        return $customer;

    }

    public function createMerchant() : Merchant
    {
        $merchant = new Merchant();
        $merchant
            ->setName('Test Merchant')
            ->setExtId('123123')
            ->setCommission(0.1)
            ->addProduct($this->createBasketItem());

        return $merchant;
    }

    public function createPayment() : Payment
    {
        $products[] = $this->createBasketItem();
        $merchants[] = $this->createMerchant();

        $payment = new Payment();
        $payment
            ->setAmount(200)
            ->setProducts($products)
            ->setCustomer($this->createCustomer())
            ->setCurrency('USD')
            ->setExtOrderId("123123123")
            ->setExtOrderUrl("https//google.com")
            ->setSubMerchants($merchants)
        ;

        return $payment;

    }
}
