## Oderopay PHP SDK
[![Build Status](https://github.com/oderopay/odero-php/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/oderopay/odero-php/actions/workflows/ci.yml)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oderopay/odero-php/badges/quality-score.png?b=main&s=afc8c7535f5e41069c230db8910bc54fc2dbd53f)](https://scrutinizer-ci.com/g/oderopay/odero-php/?branch=main)

The Oderopay PHP library provides convenient access to the Oderopay API from applications written in the PHP language. 
It includes a pre-defined set of classes for API resources that initialize themselves dynamically from API responses which makes it compatible with Oderopay API.

### Requirements

PHP 7.2.0 or later.

### Installation

You can install the bindings via Composer. Run the following command:
````bash 
composer require oderopay/odero-php
````

To use the bindings, use Composer's autoload:

````bash 
require_once('vendor/autoload.php');
````

## Dependencies

The bindings require the following extensions in order to work properly:

-   [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
-   [`json`](https://secure.php.net/manual/en/book.json.php)
-   [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) (Multibyte String)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.


## Getting Started

Simple usage looks like:

```php
$config = new \Oderopay\OderoConfig('My Store Name', '{merchant-id}', '{merchant-token}', \Oderopay\OderoConfig::ENV_STG);

$oderopay = new \Oderopay\OderoClient($config);

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
    ->setPhoneNumber('	+19159969739')
    ->setDeliveryInformation($deliveryAddress)
    ->setBillingInformation($billingAddress);
    
   

$paymentRequest = new \Oderopay\Model\Payment\Payment();
$paymentRequest
    ->setAmount(100.00)
    ->setCurrency('USD')
    ->setExtOrderId('external-random-id')
    ->setExtOrderUrl('https://mystore.com/sample-product.html')
    ->setMerchantId('{merchant-id}')
    ->setCustomer($customer)
    
$payment = $oderopay->payments->create($paymentRequest);
var_dump($payment);

```
