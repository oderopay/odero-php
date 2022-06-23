<?php
declare(strict_types=1);

namespace Oderopay\Traits;

trait FromArrayTrait
{
    /**
     * @param array $data
     * @return self
     */
    public function fromArray(array $data = [])
    {
        foreach (get_object_vars($this) as $property => $default) {
            if (!array_key_exists($property, $data)) continue;
            $this->{$property} = $data[$property]; // assign value to object
        }

        return $this;
    }

}
