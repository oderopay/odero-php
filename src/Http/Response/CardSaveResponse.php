<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

class CardSaveResponse extends BaseResponse
{
    /** @var string */
    public $operationId;

    /** @var string */
    public $message;

    /** @var array */
    public $data = [];

    /**
     * @return string
     */
    public function getOperationId(): string
    {
        return $this->operationId;
    }

    /**
     * @param string $operationId
     */
    public function setOperationId(string $operationId): void
    {
        $this->operationId = $operationId;
    }


}
