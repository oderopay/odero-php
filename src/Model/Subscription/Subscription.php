<?php
declare(strict_types=1);

namespace Oderopay\Model\Subscription;

use InvalidArgumentException;
use Oderopay\Model\AbstractRequest;

class Subscription extends AbstractRequest
{

    const INTERVAL = [
        'Weekly', 'Monthly', 'Yearly'
    ];

    /** @var string */
    protected $startDate;

    /** @var string */
    protected $endDate;

    /** @var string */
    protected $timeForBillingUtc = '00:00';

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
     * Output of given date should be ISO8601 format
     * @param string $startDate
     * @return Subscription
     */
    public function setStartDate(string $startDate): Subscription
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $startDate, new \DateTimeZone('UTC'));

        if(!$date) throw new InvalidArgumentException('startDate format should be "Y-m-d H:i:s"');

        $this->startDate = $date->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * Output is ISO8601 format
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * Output of given date should be ISO8601 format
     * @param string $endDate
     * @return Subscription
     */
    public function setEndDate(string $endDate): Subscription
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $endDate, new \DateTimeZone('UTC'));

        if(!$date) throw new InvalidArgumentException('endDate format should be "Y-m-d H:i:s"');

        $this->endDate = $date->format(\DateTime::ATOM);

        return $this;
    }

    /**
     * Hour and minute for billing
     * @return string
     */
    public function getTimeForBillingUtc(): string
    {
        return $this->timeForBillingUtc;
    }

    /**
     * Hour and minute
     * @param string $timeForBillingUtc
     * @return Subscription
     */
    public function setTimeForBillingUtc(string $timeForBillingUtc): Subscription
    {
        $time = \DateTime::createFromFormat('H:i', $timeForBillingUtc);

        if(!$time) throw new InvalidArgumentException('timeForBilling format should be "H:i"');

        $this->timeForBillingUtc = $time->format('H:i');

        return $this;
    }

    /**
     * Gets the interval
     * Default Monthly
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval ?? 'Monthly';
    }

    /**
     * Could be Weekly, Monthly, Yearly
     * Default Monthly
     * @param string $interval
     * @return Subscription
     */
    public function setInterval(string $interval): Subscription
    {
        if(!in_array($interval, self::INTERVAL)){
            $interval = 'Monthly';
        }

        $this->interval = $interval;
        return $this;
    }

    /**
     * Sets the interval as weekly
     * @return $this
     */
    public function weekly()
    {
        $this->setInterval('Weekly');

        return $this;
    }

    /**
     * @return $this
     */
    public function monthly()
    {
        $this->setInterval('Monthly');

        return $this;
    }

    /**
     * @return $this
     */
    public function yearly()
    {
        $this->setInterval('Yearly');

        return $this;
    }
}
