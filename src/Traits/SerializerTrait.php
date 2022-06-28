<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait SerializerTrait
{
    public function toArray($vars = null)
    {
        $vars = $vars ?? get_object_vars($this);

        foreach ($vars as &$key) {
            if(is_array($key)) $key = $this->toArray($key);
            if(is_object($key)) $key = $this->toArray(get_object_vars($key));
        }

        return array_filter($vars);

    }
    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
