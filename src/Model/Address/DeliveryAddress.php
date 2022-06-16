<?php
declare(strict_types=1);

namespace Oderopay\Model\Address;

class DeliveryAddress extends Address
{

    /** @var string */
    protected $deliveryType;

    /**
     * @return string
     */
    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    /**
     * @param string $deliveryType
     * @return DeliveryAddress
     */
    public function setDeliveryType(string $deliveryType): DeliveryAddress
    {
        $this->deliveryType = $deliveryType;
        return $this;
    }

}
