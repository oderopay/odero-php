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


    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     */
    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }
}
