<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

use Oderopay\Traits\FromArrayTrait;
use Psr\Http\Message\ResponseInterface;

class BaseResponse
{
    use FromArrayTrait;

    /** @var int  */
    protected $status;

    /** @var string  */
    protected $contents;

    /** @var bool */
    protected $success;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->status = $response->getStatusCode();
        $this->contents = $response->getBody()->getContents();

        $contents = json_decode($this->contents, true);
        $this->fromArray($contents);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        return $this->contents;
    }

    public function toArray()
    {
        return json_decode($this->getContents(), true);
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->status == 200;
    }
}
