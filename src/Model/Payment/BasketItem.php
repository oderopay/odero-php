<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;

class BasketItem extends AbstractRequest
{
    /** @var string */
    protected $extId;

    /** @var float */
    protected $price;

    /** @var float */
    protected $quantity;

    /** @var float */
    protected $total;

    /** @var string */
    protected $name;

    /** @var string */
    protected $imageUrl;

    /**
     * @return string
     */
    public function getExtId()
    {
        return $this->extId;
    }

    /**
     * @param string $extId
     * @return BasketItem
     */
    public function setExtId($extId)
    {
        $this->extId = $extId;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return BasketItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        if(!$this->total && $this->quantity){
            $this->total = $this->quantity * $price;
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return BasketItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        if(!$this->total && $this->price){
            $this->total = $this->price * $quantity;
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total ?? $this->price * $this->quantity;
    }

    /**
     * @param float $total
     * @return BasketItem
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BasketItem
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return BasketItem
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = base64_encode($imageUrl);
        return $this;
    }

}
