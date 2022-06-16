<?php
declare(strict_types=1);

namespace Oderopay\Model\Address;

use Oderopay\Model\AbstractRequest;

class Address extends AbstractRequest
{

    /**
     * Alpha-3 code
     * @var string
     */
    protected $country;

    /** @var string */
    protected $city;

    /** @var string */
    protected $address;

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Address
     */
    public function setAddress(string $address): Address
    {
        $this->address = $address;
        return $this;
    }
}
