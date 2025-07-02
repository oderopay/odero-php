<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Subscription\Subscription;

class Payment extends AbstractRequest
{
    /** @var ?string */
    protected ?string $merchantId;

    /** @var null|string */
    protected ?string $cardToken = null;

    /** @var ?float */
    protected ?float $amount = 0;

    /** @var ?string */
    protected ?string$currency;

    /** @var ?string */
    protected ?string $extOrderId;

    /** @var ?string */
    protected ?string $extOrderUrl;

    /** @var ?string */
    protected ?string $returnUrl;

    /** @var bool */
    protected bool $saveCard = false;

    /** @var array<Merchant> */
    protected array $submerchants = [];

    /** @var ?Customer */
    protected ?Customer $customer;

    /** @var array<BasketItem> */
    protected array $products = [];

    /** @var bool  */
    protected bool $recurring = false;

    /** @var null|Subscription */
    protected ?Subscription $recurringInformation = null;

    /** @var ?string */
    protected ?string $successUrl = null;

    /** @var ?string */
    protected ?string $failUrl = null;

    /** @var bool  */
    protected bool $extOrderIsInstalment = false;

    /** @var string  */
    protected string $extOrderInstalmentBank = 'bt';

    /** @var array  */
    protected array $extOrderInstalmentPayments = [];

	protected $description = null;

    public function __construct()
    {
        $this->submerchants = [];
    }

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
	public function setMerchantId(?string $merchantId): Payment
	{
		$this->merchantId = $merchantId;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCardToken(): ?string
	{
		return $this->cardToken;
	}

	/**
	 * @param string|null $cardToken
	 */
	public function setCardToken(?string $cardToken): Payment
	{
		$this->cardToken = $cardToken;

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
     * @return Payment
     */
    public function setAmount(float $amount): Payment
    {
        $this->amount = $amount;
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
     * @param string $currency
     * @return Payment
     */
    public function setCurrency(string $currency): Payment
    {
        $this->currency = $currency;
        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getExtOrderId(): ?string
	{
		return $this->extOrderId;
	}

    /**
     * @param string $extOrderId
     * @return Payment
     */
    public function setExtOrderId(string $extOrderId): Payment
    {
        $this->extOrderId = $extOrderId;
        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getExtOrderUrl(): ?string
	{
		return $this->extOrderUrl;
	}

	/**
	 * @param string|null $extOrderUrl
	 * @return Payment
	 */
	public function setExtOrderUrl(?string $extOrderUrl): Payment
	{
		if(str_starts_with($extOrderUrl, 'http')){
			$extOrderUrl = base64_encode($extOrderUrl);
		}

		$this->extOrderUrl = $extOrderUrl;

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
	 * @return Payment
	 */
	public function setReturnUrl(?string $returnUrl): Payment
	{
		if(str_starts_with($returnUrl, 'http')){
			$returnUrl = base64_encode($returnUrl);
		}

		$this->returnUrl = $returnUrl;

		return $this;

	}

	/**
	 * @return bool
	 */
	public function isSaveCard(): bool
	{
		return $this->saveCard;
	}

    /**
     * @param bool $saveCard
     * @return Payment
     */
    public function setSaveCard(bool $saveCard): Payment
    {
        $this->saveCard = $saveCard;
        return $this;
    }

	/**
	 * @return array
	 */
	public function getSubmerchants(): array
	{
		return $this->submerchants;
	}

	/**
	 * @param array $submerchants
	 * @return Payment
	 */
	public function setSubmerchants(array $submerchants): Payment
	{
		$this->submerchants = $submerchants;

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
	 * @return Payment
	 */
	public function setCustomer(?Customer $customer): Payment
	{
		$this->customer = $customer;

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
	 * @param array $products
	 * @return Payment
	 */
	public function setProducts(array $products): Payment
	{
		$this->products = $products;

		return $this;

	}

	/**
	 * @return bool
	 */
	public function isSubscription(): bool
	{
		return $this->recurring;
	}

	/**
	 * @param bool $recurring
	 */
	public function setRecurring(bool $recurring): Payment
	{
		$this->recurring = $recurring;

		return $this;
	}

	/**
	 * @return Subscription|null
	 */
	public function getSubscription(): ?Subscription
	{
		return $this->recurringInformation;
	}

	/**
	 * @param Subscription|null $recurringInformation
	 */
	public function setRecurringInformation(?Subscription $recurringInformation): Payment
	{
		$this->recurringInformation = $recurringInformation;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSuccessUrl(): ?string
	{
		return $this->successUrl;
	}

	/**
	 * @param string|null $successUrl
	 * @return Payment
	 */
	public function setSuccessUrl(?string $successUrl): Payment
	{
		if(str_starts_with($successUrl, 'http')){
			$successUrl = base64_encode($successUrl);
		}

		$this->successUrl = $successUrl;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getFailUrl(): ?string
	{
		return $this->failUrl;
	}

	/**
	 * @param string|null $failUrl
	 * @return Payment
	 */
	public function setFailUrl(?string $failUrl): Payment
	{
		if(str_starts_with($failUrl, 'http')){
			$failUrl = base64_encode($failUrl);
		}

		$this->failUrl = $failUrl;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isExtOrderIsInstalment(): bool
	{
		return $this->extOrderIsInstalment;
	}

	/**
	 * @param bool $extOrderIsInstalment
	 * @return Payment
	 */
	public function setExtOrderIsInstalment(bool $extOrderIsInstalment): Payment
	{
		$this->extOrderIsInstalment = $extOrderIsInstalment;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getExtOrderInstalmentBank(): string
	{
		return $this->extOrderInstalmentBank;
	}

	/**
	 * @param string $extOrderInstalmentBank
	 */
	public function setExtOrderInstalmentBank(string $extOrderInstalmentBank): Payment
	{
		$this->extOrderInstalmentBank = $extOrderInstalmentBank;

		return $this;
	}

    /**
     * @return Payment
     */
    public function setExtOrderInstalmentPayments($extOrderInstalmentPayments)
    {
        if (!is_array($extOrderInstalmentPayments)){
            $this->extOrderInstalmentPayments = [$extOrderInstalmentPayments];

            return $this;
        }

        $this->extOrderInstalmentPayments = $extOrderInstalmentPayments;

        return $this;
    }

	/**
	 * @return null
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param null $description
	 */
	public function setDescription($description): self
	{
		$this->description = $description;

		return $this;
	}

}

