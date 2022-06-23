<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;

class Merchant extends AbstractRequest
{
    /** @var string */
    protected $extId;

    /** @var string */
    protected $name;

    /** @var float */
    protected $amount;

    /** @var float */
    protected $commission;

    /** @var BasketItem[] */
    protected $products = [];

    /**
     * @return string
     */
    public function getExtId()
    {
        return $this->extId;
    }

    /**
     * @param string $extId
     * @return Merchant
     */
    public function setExtId($extId)
    {
        $this->extId = $extId;
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
     * @return Merchant
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        if(!$this->amount){
            foreach ($this->getProducts() as $product) {
                $this->amount += $product->getTotal();
            }
        }

        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Merchant
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param float $commission
     * @return Merchant
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;
        return $this;
    }

    /**
     * @return array<BasketItem>
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param BasketItem $products
     * @return Merchant
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param BasketItem $product
     * @return Merchant
     */
    public function addProduct(BasketItem $product)
    {
        $this->products[] = $product;

        return $this;
    }

    public function removeProduct(BasketItem $product)
    {
        foreach ($this->products as $k => $_product) {
            if($_product->getExtId() === $product->getExtId()){
                unset($this->products[$k]);
            }
        }

        return $this;
    }
}
