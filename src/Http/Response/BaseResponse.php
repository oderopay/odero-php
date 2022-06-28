<?php
declare(strict_types=1);

namespace Oderopay\Http\Response;

use Oderopay\Http\HttpResponse;
use Oderopay\Traits\FromArrayTrait;
use Oderopay\Traits\SerializerTrait;
use Psr\Http\Message\ResponseInterface;

class BaseResponse
{
    use FromArrayTrait, SerializerTrait;

    /** @var int  */
    protected $status;

    /** @var bool */
    protected $success;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /** @var string */
    protected $message;

    /**
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->status = $response->code;

        if($response->content){
            $contents = json_decode($response->content, true);
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
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->status == 200;
    }
}
