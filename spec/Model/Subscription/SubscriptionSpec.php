<?php

namespace spec\Oderopay\Model\Subscription;

use Oderopay\Model\Subscription\Subscription;
use PhpSpec\ObjectBehavior;

class SubscriptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Subscription::class);
    }

    public function it_should_create_subscription_model()
    {
        $this
            ->setStartDate('2020-01-01 00:00:00')
            ->setEndDate('2021-01-01 00:00:00')
            ->setTimeForBillingUtc('14:10')
            ->weekly()
        ;

        $this->getStartDate()->shouldReturn('2020-01-01T00:00:00+00:00');
        $this->getEndDate()->shouldReturn('2021-01-01T00:00:00+00:00');
        $this->getInterval()->shouldReturn('Weekly');

        $this->monthly();
        $this->getInterval()->shouldReturn('Monthly');

        $this->yearly();
        $this->getInterval()->shouldReturn('Yearly');

    }

    public function it_should_throw_error_on_wrong_start_date_format()
    {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('setStartDate',['2020-01-01']);

    }

    public function it_should_throw_error_on_wrong_end_date_format()
    {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('setEndDate',['invalid-format']);

    }

    public function it_should_throw_error_on_wrong_time_for_billing_format()
    {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('setTimeForBillingUtc',['invalid-format']);

    }
}
