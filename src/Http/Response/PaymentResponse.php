<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

use Oderopay\Http\HttpResponse;

class PaymentResponse extends BaseResponse
{
    const TYPE_ONE_TIME = 'one_time';
    const TYPE_STORED_CARD = 'stored_card';

    /** @var string */
    public $merchantId;

    /** @var string */
    public $paymentId;

    /** @var float */
    public $amount;

    /** @var string */
    public $currency;

    /** @var string */
    public $type;

    /** @var \DateTime */
    public $requestedAt;

    /** @var bool */
    public $recurring = false;

    /** @var  */
    public $status;

    /** @var array */
    public $recurringInformation;

    public function __construct(HttpResponse $response)
    {
        parent::__construct($response);

        $this->type = $this->type == 1 ? self::TYPE_ONE_TIME : self::TYPE_STORED_CARD;
    }
}
