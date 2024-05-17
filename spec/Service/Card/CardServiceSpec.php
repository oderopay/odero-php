<?php

namespace spec\Oderopay\Service\Card;

use Oderopay\Http\HttpClient;
use Oderopay\Http\Response\CardSaveResponse;
use Oderopay\Model\Card\SaveCard;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use Oderopay\Service\BaseService;
use Oderopay\Service\Card\CardService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class CardServiceSpec extends ObjectBehavior
{
    public function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantId', 'token');
        $oderoClient = new OderoClient($config);

        $cardSuccess = file_get_contents(OderoClient::APP_DIR . "stubs/card/response.json");
        $cardError = file_get_contents(OderoClient::APP_DIR . "stubs/card/bad_request.json");

		$responses = [
			new MockResponse($cardSuccess),
			new MockResponse($cardError, ['http_code' => 400]),
		];

		$client = new MockHttpClient($responses);
        $http = new HttpClient($client);

        $this->beConstructedWith($oderoClient, $http);
        $this->shouldBeAnInstanceOf(BaseService::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CardService::class);
        $this->shouldHaveType(BaseService::class);
    }

    public function it_should_save_card()
    {
        $stub = file_get_contents(OderoClient::APP_DIR . "stubs/card/response.json");

        $card = new SaveCard();
        /** @var CardSaveResponse $saveCard */
        $saveCard = $this->create($card);
        $saveCard->shouldReturnAnInstanceOf(CardSaveResponse::class);
        $saveCard->getCode()->shouldReturn(200);
        $saveCard->getOperationId()->shouldReturn('uuid');
        $saveCard->getMessage()->shouldReturn('string');
        $saveCard->toArray()->shouldBeArray();
    }
}
