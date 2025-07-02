<?php

namespace Oderopay\Model\Webhook;

use Oderopay\Model\AbstractRequest;

class BaseWebhook extends AbstractRequest
{

    /** @var string */
    protected $type;

    /** @var string */
    protected $operationId;

    /** @var string */
    protected $status = 'ERROR';

    /** @var string */
    protected $message;

    /** @var array  */
    protected $data = [];

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): BaseWebhook
    {
        $this->type = $type;

	    return $this;
    }

    /**
     * @return string
     */
    public function getOperationId()
    {
        return $this->operationId;
    }

    /**
     * @param string $operationId
     */
    public function setOperationId(string $operationId): BaseWebhook
    {
        $this->operationId = $operationId;
	    return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): BaseWebhook
    {
        $this->status = $status;

		return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): BaseWebhook
    {
        $this->message = $message;

		return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): BaseWebhook
    {
        $this->data = $data;

	    return $this;
    }

}
