<?php

namespace spec\Oderopay\Service\Payment;

use Oderopay\Http\HttpClient;
use Oderopay\Model\Payment\Payment;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use Oderopay\Service\BaseService;
use Oderopay\Service\Payment\SubscriptionService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SubscriptionServiceSpec extends ObjectBehavior
{
    public function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantId', 'token');
        $oderoClient = new OderoClient($config);

		$client = new MockHttpClient();
		$http = new HttpClient($client);


        $this->beConstructedWith($oderoClient, $http);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType(SubscriptionService::class);
        $this->shouldBeAnInstanceOf(BaseService::class);
    }

    public function it_throws_exception_if_no_subscription_on_payment()
    {
        $this->shouldThrow(\InvalidArgumentException::class)
            ->during('create', [new Payment()]);
    }
}
