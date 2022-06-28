<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait SerializerTrait
{
    public function toArray($vars = null)
    {
        $vars = $vars ?? get_object_vars($this);

        foreach ($vars as &$keys) {
            if(is_object($keys)) $keys = $this->toArray(get_object_vars($keys));
            if(is_array($keys)) $keys = $this->toArray($keys);
        }

        return array_filter($vars);

    }
    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
