<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait SerializerTrait
{
    public function toArray($vars = null)
    {
        $vars = $vars ?? array_filter(get_object_vars($this));

        foreach ($vars as &$key) {
            if(is_array($key)) $key = $this->toArray($key);
            if(is_object($key)) $key = $this->toArray(get_object_vars($key));
        }

        return $vars;

    }
    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
