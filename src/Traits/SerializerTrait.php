<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait SerializerTrait
{
    public function toArray($vars = null)
    {
        $vars = $vars ?? get_object_vars($this);

        $arr =  array_map(function (&$key) {
           if(is_object($key)){
               $key = $this->toArray(get_object_vars($key));
           }
           return $key;
        }, $vars);

        return array_filter($arr);

    }
    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
