<?php
declare(strict_types=1);

namespace Oderopay\Model\Card;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Payment\Customer;

class SaveCard extends AbstractRequest
{
    protected ?string $merchantId;

    protected ?string $returnUrl;

    protected ?string $currency;

    /** @var ?Customer */
    protected ?Customer $customer;

	/**
	 * @return string|null
	 */
	public function getMerchantId(): ?string
	{
		return $this->merchantId;
	}

	/**
	 * @param string|null $merchantId
	 */
	public function setMerchantId(?string $merchantId): SaveCard
	{
		$this->merchantId = $merchantId;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getReturnUrl(): ?string
	{
		return $this->returnUrl;
	}

	/**
	 * @param string|null $returnUrl
	 */
	public function setReturnUrl(?string $returnUrl): SaveCard
	{
		$this->returnUrl = $returnUrl;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCurrency(): ?string
	{
		return $this->currency;
	}

	/**
	 * @param string|null $currency
	 */
	public function setCurrency(?string $currency): SaveCard
	{
		$this->currency = $currency;

		return $this;
	}

	/**
	 * @return Customer|null
	 */
	public function getCustomer(): ?Customer
	{
		return $this->customer;
	}

	/**
	 * @param Customer|null $customer
	 */
	public function setCustomer(?Customer $customer): SaveCard
	{
		$this->customer = $customer;

		return $this;
	}
}
