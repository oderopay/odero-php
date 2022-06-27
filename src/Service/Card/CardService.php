<?php
declare(strict_types=1);

namespace Oderopay\Service\Card;

use Oderopay\Model\Card\SaveCard;
use Oderopay\Response\CardSaveResponse;
use Oderopay\Service\BaseService;

class CardService extends BaseService
{

    public function create(SaveCard $card) : CardSaveResponse
    {
        $card->setMerchantId($this->client->config->getMerchantId());

        $response = $this->request('POST','/api/cards', ['form_params' => $card->toArray()]);

        return new CardSaveResponse($response);
    }
}
