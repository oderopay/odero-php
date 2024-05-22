<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;

class Merchant extends AbstractRequest
{
    /** @var ?string */
    protected ?string$extId;

    /** @var ?string */
    protected ?string $name;

    /** @var ?float */
    protected ?float $amount;

    /** @var ?float */
    protected ?float $commission;

    /** @var BasketItem[] */
    protected array $products = [];

	/**
	 * @return string|null
	 */
	public function getExtId(): ?string
	{
		return $this->extId;
	}

    /**
     * @param string $extId
     * @return Merchant
     */
    public function setExtId($extId) : Merchant
    {
        $this->extId = $extId;
        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

    /**
     * @param string $name
     * @return Merchant
     */
    public function setName(string $name) : Merchant
    {
        $this->name = $name;
        return $this;
    }

	/**
	 * @return float|null
	 */
	public function getAmount(): ?float
	{
		return $this->amount;
	}

    /**
     * @param float $amount
     * @return Merchant
     */
    public function setAmount(float $amount): Merchant
    {
        $this->amount = $amount;
        return $this;
    }

	/**
	 * @return float|null
	 */
	public function getCommission(): ?float
	{
		return $this->commission;
	}

    /**
     * @param float $commission
     * @return Merchant
     */
    public function setCommission(float $commission): Merchant
    {
        $this->commission = $commission;
        return $this;
    }

	/**
	 * @return array
	 */
	public function getProducts(): array
	{
		return $this->products;
	}

    /**
     * @param BasketItem[] $products
     * @return Merchant
     */
    public function setProducts(array $products) : Merchant
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param BasketItem $product
     * @return Merchant
     */
    public function addProduct(BasketItem $product): Merchant
	{
        $this->products[] = $product;

        return $this;
    }

    public function removeProduct(BasketItem $product): Merchant
	{
        foreach ($this->products as $k => $_product) {
            if($_product->getExtId() === $product->getExtId()){
                unset($this->products[$k]);
            }
        }

        return $this;
    }
}
