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
    ->setExtOrderUrl('https://mystore.com/orders/3244234')
    ->setReturnUrl('https://mystore.com/sample-product.html')
    ->setMerchantId('{merchant-id}')
    ->setCustomer($customer)
    ->setProducts($products)
    ->setCardToken('1065f952bb77090d7929f933748a31a8c51a707d133d09e9224dd3ca30c78f4d') //add card token
    ->setSuccessUrl('https://tokenco.shop/?success=true&orderId=324234&test=test')
    ->setFailUrl('https://tokenco.shop/?success=false&orderId=324234&test=test')
;
$payment = $oderopay->payments->create($paymentRequest); //PaymentIntentResponse

dd($payment);
if($payment->isSuccess()){
    dump($payment);
    //redirect to $payment->data['url'];
}else{
    log($payment->message);
}
