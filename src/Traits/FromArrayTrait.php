<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait FromArrayTrait
{
    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data = []) {
        foreach (get_object_vars($obj = new self) as $property => $default) {
            if (!array_key_exists($property, $data)) continue;
            $obj->{$property} = $data[$property]; // assign value to object
        }

        return $obj;
    }

}
