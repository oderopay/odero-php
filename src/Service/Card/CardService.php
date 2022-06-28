<?php
declare(strict_types=1);

namespace Oderopay\Service\Card;

use Oderopay\Http\Response\CardDeleteResponse;
use Oderopay\Http\Response\CardSaveResponse;
use Oderopay\Model\Card\SaveCard;
use Oderopay\Service\BaseService;

class CardService extends BaseService
{

    /**
     * @param SaveCard $card
     * @return \Oderopay\Http\Response\CardSaveResponse
     */
    public function create(SaveCard $card) : CardSaveResponse
    {
        $card->setMerchantId($this->client->config->getMerchantId());

        $response = $this->request('POST','api/cards', ['form_params' => $card->toArray()]);

        return new CardSaveResponse($response);
    }

    /**
     * @param $cardToken
     * @return CardDeleteResponse
     */
    public function delete($cardToken): CardDeleteResponse
    {
        $response = $this->request('DELETE','api/cards/' . $cardToken);

        return new CardDeleteResponse($response);
    }
}
