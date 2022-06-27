<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

use Oderopay\Traits\FromArrayTrait;

class PaymentIntentResponse extends BaseResponse
{
    use FromArrayTrait;

    /** @var string */
    public $requestId;

    /** @var string */
    public $message;

    /** @var array */
    public $data;

}
