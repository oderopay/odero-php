<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

use Oderopay\Http\HttpResponse;
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
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->status = $response->code;
        $this->contents = $response->content;

        if($response->content){
            $contents = json_decode($this->contents, true);
            $this->fromArray($contents);
        }else{
            $this->success = false;
            $this->message = $response->message;
        }
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
