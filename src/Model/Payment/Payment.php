<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Subscription\Subscription;

class Payment extends AbstractRequest
{
    /** @var string */
    protected $merchantId;

    /** @var null|string */
    protected $cardToken = null;

    /** @var float */
    protected $amount;

    /** @var string */
    protected $currency;

    /** @var string */
    protected $extOrderId;

    /** @var string */
    protected $extOrderUrl;

    /** @var string */
    protected $returnUrl;

    /** @var bool */
    protected $saveCard;

    /** @var array<Merchant> */
    protected $submerchants = [];

    /** @var Customer */
    protected $customer;

    /** @var array<BasketItem> */
    protected $products;

    /** @var bool  */
    protected $recurring = false;

    /** @var null|Subscription */
    protected $recurringInformation = null;

    /** @var string */
    protected $successUrl = null;

    /** @var string */
    protected $failUrl = null;

    /** @var bool  */
    protected $extOrderIsInstalment = false;

    /** @var string  */
    protected $extOrderInstalmentBank = 'bt';

    /** @var array  */
    protected $extOrderInstalmentPayments = [];

    public function __construct()
    {
        $this->submerchants = [];
    }
    /**
     * @return array<BasketItem>
     */
    public function getProducts(): array
    {
        return $this->products ?? [];
    }

    /**
     * @param BasketItem[] $products
     * @return Payment
     */
    public function setProducts(array $products): Payment
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return Payment
     */
    public function setMerchantId(string $merchantId): Payment
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return float
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
     * @return string
     */
    public function getCurrency(): string
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
     * @return string
     */
    public function getExtOrderId(): string
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
     * @return string
     */
    public function getExtOrderUrl(): string
    {
        return $this->extOrderUrl;
    }

    /**
     * @param string $extOrderUrl
     * @return Payment
     */
    public function setExtOrderUrl(string $extOrderUrl): Payment
    {
        $this->extOrderUrl = base64_encode($extOrderUrl);
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     * @return Payment
     */
    public function setReturnUrl(string $returnUrl): Payment
    {
        $this->returnUrl = base64_encode($returnUrl);
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
     * @return array<Merchant>
     */
    public function getSubMerchants() : ?array
    {
        return $this->submerchants;
    }

    /**
     * @param Merchant[] $subMerchants
     * @return Payment
     */
    public function setSubMerchants(array $subMerchants): Payment
    {
        $this->submerchants = $subMerchants;
        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return Payment
     */
    public function setCustomer(Customer $customer): Payment
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRecurring(): bool
    {
        $this->recurring = $this->getSubscription() instanceof Subscription;

        return $this->recurring;
    }


    /**
     * @return Subscription|null
     */
    public function getSubscription(): ?Subscription
    {
        return $this->recurringInformation;
    }

    /**
     * @param Subscription $subscription
     * @return Payment
     */
    public function setSubscription(Subscription $subscription): Payment
    {
        $this->recurringInformation = $subscription;

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
     * @return Payment
     */
    public function setCardToken(?string $cardToken): Payment
    {
        $this->cardToken = $cardToken;
        return $this;
    }

    /**
     * @param bool $recurring
     * @return Payment
     */
    public function setRecurring(bool $recurring): Payment
    {
        $this->recurring = $recurring;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     */
    public function setSuccessUrl(?string $successUrl)
    {
        if(is_null($successUrl)){
            $this->successUrl = $this->getReturnUrl();
        }else{
            $this->successUrl =  base64_encode($successUrl);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    /**
     * @param string $failUrl
     */
    public function setFailUrl(?string $failUrl)
    {
        if(is_null($failUrl)){
            $this->failUrl = $this->getReturnUrl();
        }else{
            $this->failUrl =  base64_encode($failUrl);
        }

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
     */
    public function setExtOrderIsInstalment(bool $extOrderIsInstalment): void
    {
        $this->extOrderIsInstalment = $extOrderIsInstalment;
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
    public function setExtOrderInstalmentBank(string $extOrderInstalmentBank): void
    {
        $this->extOrderInstalmentBank = $extOrderInstalmentBank;
    }

    /**
     * @return array
     */
    public function getExtOrderInstalmentPayments(): array
    {
        return $this->extOrderInstalmentPayments;
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

}

