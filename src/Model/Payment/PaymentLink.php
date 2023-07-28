<?php
declare(strict_types=1);

namespace Oderopay\Model\Payment;

use Oderopay\Model\AbstractRequest;
use Oderopay\Model\Subscription\Subscription;

class PaymentLink extends Payment
{
    public $expireAt;

    public $itemDescription;

    public $email = null;

    public $amount;

    public function setExpireAt(\DateTime $date)
    {
        $this->expireAt = $date->format('Y-m-d G:i:s');

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemDescription()
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
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

}

