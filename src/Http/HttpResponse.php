<?php
declare(strict_types=1);

namespace Oderopay\Http;

class HttpResponse
{
    /** @var int */
    public $code;

    /** @var string */
    public $content;

    /** @var string */
    public $message;
}
