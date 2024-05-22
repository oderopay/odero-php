<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Address\BillingAddress;
use Oderopay\Model\Address\DeliveryAddress;

class Customer extends AbstractRequest
{
    /** @var ?string */
    protected ?string $email;

    /** @var ?string */
    protected ?string $phoneNumber;

    /** @var ?DeliveryAddress */
    protected ?DeliveryAddress $deliveryInformation;

    /** @var ?BillingAddress */
    protected ?BillingAddress $billingInformation;

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

    /**
     * @param string $email
     * @return Customer
     */
    public function setEmail(string $email): Customer
    {
        $this->email = $email;
        return $this;
    }

	/**
	 * @return string|null
	 */
	public function getPhoneNumber(): ?string
	{
		return $this->phoneNumber;
	}

    /**
     * @param string $phoneNumber
     * @return Customer
     */
    public function setPhoneNumber(string $phoneNumber): Customer
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

	/**
	 * @return DeliveryAddress|null
	 */
	public function getDeliveryInformation(): ?DeliveryAddress
	{
		return $this->deliveryInformation;
	}

    /**
     * @param DeliveryAddress $deliveryInformation
     * @return Customer
     */
    public function setDeliveryInformation(DeliveryAddress $deliveryInformation): Customer
    {
        $this->deliveryInformation = $deliveryInformation;
        return $this;
    }

	/**
	 * @return BillingAddress|null
	 */
	public function getBillingInformation(): ?BillingAddress
	{
		return $this->billingInformation;
	}

    /**
     * @param BillingAddress $billingInformation
     * @return Customer
     */
    public function setBillingInformation(BillingAddress $billingInformation): Customer
    {
        $this->billingInformation = $billingInformation;
        return $this;
    }

}
