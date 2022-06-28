<?php
declare(strict_types=1);

namespace Oderopay\Model\Card;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Payment\Customer;

class SaveCard extends AbstractRequest
{
    protected $merchantId;

    protected $returnUrl;

    protected $currency;

    /** @var Customer */
    protected $customer;

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param mixed $merchantId
     * @return SaveCard
     */
    public function setMerchantId($merchantId): SaveCard
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param mixed $returnUrl
     * @return SaveCard
     */
    public function setReturnUrl($returnUrl): SaveCard
    {
        $this->returnUrl = base64_encode($returnUrl);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return SaveCard
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
     * @param Customer|null $customer
     * @return SaveCard
     */
    public function setCustomer(?Customer $customer): SaveCard
    {
        $this->customer = $customer;
        return $this;
    }

}
