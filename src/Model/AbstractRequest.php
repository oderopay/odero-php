<?php
declare(strict_types=1);

namespace Oderopay\Model;

use Oderopay\Traits\FromArrayTrait;
use Oderopay\Traits\SerializerTrait;

abstract class AbstractRequest
{
    use SerializerTrait, FromArrayTrait;
}
