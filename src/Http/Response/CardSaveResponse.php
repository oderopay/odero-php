<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

class CardSaveResponse extends BaseResponse
{
    /** @var string */
    public $requestId;

    /** @var string */
    public $message;

    /** @var array */
    public $data = [];
}
