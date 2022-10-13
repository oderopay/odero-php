<?php

namespace spec\Oderopay\Service\Card;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Oderopay\Http\HttpClient;
use Oderopay\Http\Response\CardSaveResponse;
use Oderopay\Model\Card\SaveCard;
use Oderopay\OderoClient;
use Oderopay\OderoConfig;
use Oderopay\Service\BaseService;
use Oderopay\Service\Card\CardService;
use PhpSpec\ObjectBehavior;

class CardServiceSpec extends ObjectBehavior
{
    public function let()
    {
        $config = new OderoConfig('MY Store Name', 'merchantId', 'token');
        $oderoClient = new OderoClient($config);

        $cardSuccess = file_get_contents(OderoClient::APP_DIR . "stubs/card/response.json");
        $cardError = file_get_contents(OderoClient::APP_DIR . "stubs/card/bad_request.json");

        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], $cardSuccess),
            new Response(400, [], $cardError),
            new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);

        $client = new Client(['base_uri' => $config->getApiHost(), 'handler' => $handlerStack]);
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
