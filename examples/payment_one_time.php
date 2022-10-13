<?php
require_once "client.php";

$billingAddress = new \Oderopay\Model\Address\BillingAddress();
$billingAddress
    ->setAddress('185 Berry St #550, San Francisco, CA 94107, USA')
    ->setCity('San Francisco')
    ->setCountry('USA');

$deliveryAddress = new \Oderopay\Model\Address\DeliveryAddress();
$deliveryAddress
    ->setAddress('185 Berry St #550, San Francisco, CA 94107, USA')
    ->setCity('San Francisco')
    ->setCountry('USA')
    ->setDeliveryType('Courier');

$customer = new \Oderopay\Model\Payment\Customer();
$customer
    ->setEmail('customer@email.com')
    ->setPhoneNumber('+40759969739')
    ->setDeliveryInformation($deliveryAddress)
    ->setBillingInformation($billingAddress);

$products = [];
$product1 = new \Oderopay\Model\Payment\BasketItem();
$product1
    ->setExtId('123')
    ->setImageUrl('https://site.com/image/product1.jpg')
    ->setName('Product Name')
    ->setPrice(99.99)
    ->setQuantity(1);

$products[] = $product1;

$product2 = new \Oderopay\Model\Payment\BasketItem();
$product2
    ->setExtId('123')
    ->setImageUrl('https://site.com/image/product1.jpg')
    ->setName('Product Name')
    ->setPrice(99.99)
    ->setQuantity(1);

$products[] = $product2;

$paymentRequest = new \Oderopay\Model\Payment\Payment();
$paymentRequest
    ->setCurrency('RON')
    ->setExtOrderId('external-random-id')
    ->setExtOrderUrl('https://tokenco.shop/orders/3244234')
    ->setReturnUrl('https://tokenco.shop/')
    ->setMerchantId('56a72ffe-8d69-48df-a10e-91e64d6c7033')
    ->setCustomer($customer)
    ->setProducts($products)
    ->setSaveCard(true);
;

$payment = $oderopay->payments->create($paymentRequest); //PaymentIntentResponse

dd($payment);
if($payment->isSuccess()){
    dump($payment);

    //redirect to $payment->data['url'];
}else{
    echo $payment->message;
}
