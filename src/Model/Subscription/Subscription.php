<?php
declare(strict_types=1);

namespace Oderopay\Model\Subscription;

use Oderopay\Model\Payment\Payment;

class Subscription
{

    /** @var string */
    protected $startDate;

    /** @var string */
    protected $endDate;

    /** @var string */
    protected $timeForBillingUtc;

    /** @var string */
    protected $interval;

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     * @return Subscription
     */
    public function setStartDate(string $startDate): Subscription
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     * @return Subscription
     */
    public function setEndDate(string $endDate): Subscription
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeForBillingUtc(): string
    {
        return $this->timeForBillingUtc;
    }

    /**
     * @param string $timeForBillingUtc
     * @return Subscription
     */
    public function setTimeForBillingUtc(string $timeForBillingUtc): Subscription
    {
        $this->timeForBillingUtc = $timeForBillingUtc;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     * @return Subscription
     */
    public function setInterval(string $interval): Subscription
    {
        $this->interval = $interval;
        return $this;
    }

}
