<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;

class BasketItem extends AbstractRequest
{
    /** @var ?string */
    protected ?string $extId;

    /** @var ?float */
    protected ?float $price;

    /** @var ?int */
    protected ?int $quantity = 1;

    /** @var ?float */
    protected ?float $total;

    /** @var ?string */
    protected ?string $name;

    /** @var ?string */
    protected ?string $imageUrl;

	/**
	 * @return string|null
	 */
	public function getExtId(): ?string
	{
		return $this->extId;
	}

	/**
	 * @param string|null $extId
	 * @return BasketItem
	 */
	public function setExtId(?string $extId): BasketItem
	{
		$this->extId = $extId;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getPrice(): ?float
	{
		return $this->price;
	}

	/**
	 * @param float|null $price
	 * @return BasketItem
	 */
	public function setPrice(?float $price): BasketItem
	{
		$this->price = $price;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getQuantity(): ?int
	{
		return $this->quantity;
	}

	/**
	 * @param int|null $quantity
	 * @return BasketItem
	 */
	public function setQuantity(?int $quantity): BasketItem
	{
		$this->quantity = $quantity;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getTotal(): ?float
	{
		return $this->price * $this->quantity;
	}

	/**
	 * @param float|null $total
	 * @return BasketItem
	 */
	public function setTotal(?float $total): BasketItem
	{
		$this->total = $total;

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
	 * @param string|null $name
	 * @return BasketItem
	 */
	public function setName(?string $name): BasketItem
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getImageUrl(): ?string
	{
		return $this->imageUrl;
	}

	/**
	 * @param string|null $imageUrl
	 * @return BasketItem
	 */
	public function setImageUrl(?string $imageUrl): BasketItem
	{
		if(str_starts_with($imageUrl, 'http')){
			$imageUrl = base64_encode($imageUrl);
		}

		$this->imageUrl = $imageUrl;

		return $this;
	}
}
