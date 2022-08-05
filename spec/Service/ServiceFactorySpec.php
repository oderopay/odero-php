<?php

namespace spec\Oderopay\Service;

use Oderopay\OderoClient;
use Oderopay\OderoClientInterface;
use Oderopay\OderoConfig;
use Oderopay\Service\AbstractServiceFactory;
use Oderopay\Service\Card\CardService;
use Oderopay\Service\Payment\PaymentService;
use Oderopay\Service\Payment\SubscriptionService;
use Oderopay\Service\Webhook\WebhookService;
use PhpSpec\ObjectBehavior;

class ServiceFactorySpec extends ObjectBehavior
{
    function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantId', 'token');
        $oderoClient = new OderoClient($config);
        $this->beConstructedWith($oderoClient);
        $this->shouldBeAnInstanceOf(AbstractServiceFactory::class);
    }

    function it_should_have_odero_client()
    {
        $this->getClient()->shouldBeAnInstanceOf(OderoClientInterface::class);
    }

    function it_should_have_payment_service_class(){
        $this->getServiceClass('payments')->shouldBe(PaymentService::class);
    }

    function it_should_have_card_service_class(){
        $this->getServiceClass('cards')->shouldBe(CardService::class);
    }

    function it_should_have_subscription_service_class(){
        $this->getServiceClass('subscriptions')->shouldBe(SubscriptionService::class);
    }

    function it_should_have_webhook_service_class(){
        $this->getServiceClass('webhooks')->shouldBe(WebhookService::class);
    }
}
