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

    /** @var int */
    public $code;

    /** @var int  */
    public $status;

    /** @var bool */
    public $success;

    /**
     * @var ResponseInterface
     */
    public $response;

    /** @var string */
    public $message;

    /**
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->code = $response->code;

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
        return $this->code == 200;
    }
}
