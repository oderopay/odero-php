<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;


class PaymentLink extends Payment
{
    public ?string $expireAt;

    public ?string $itemDescription;

    public ?string $email = null;

    public ?float $amount;

    public function setExpireAt(\DateTime $date)
    {
        $this->expireAt = $date->format('Y-m-d G:i:s');

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemDescription(): string
    {
        return $this->itemDescription;
    }

    /**
     * @param mixed $itemDescription
     */
    public function setItemDescription($itemDescription): PaymentLink
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email): PaymentLink
    {
        $this->email = $email;

		return $this;

    }

}

