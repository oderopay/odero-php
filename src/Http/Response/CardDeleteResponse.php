<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

class CardDeleteResponse extends BaseResponse
{

    /** @var null|string  */
    public $requestId = null;

    /** @var null|string */
    public $message = null;
}
