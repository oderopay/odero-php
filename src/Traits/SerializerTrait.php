<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait SerializerTrait
{
    public function toArray()
    {
        return get_object_vars($this);
    }
    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
