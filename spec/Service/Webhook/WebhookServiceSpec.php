<?php

namespace spec\Oderopay\Service\Webhook;

use Oderopay\Service\BaseService;
use Oderopay\Service\Webhook\WebhookService;
use spec\Oderopay\Service\BaseServiceSpec;

class WebhookServiceSpec extends BaseServiceSpec
{

    public function let()
    {
        $this->beConstructedWith($this->getOderoClient(), $this->getHttpClient());

    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BaseService::class);
    }

    public function it_should_have_handle_method()
    {
        $payload = [];
        $model = $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\BaseWebhook::class);

        $model->getStatus()->shouldBe('ERROR');

    }

    public function it_should_throw_exception_with_non_existing_type()
    {
        $payload = ['type'=> 'Invalid Type'];
        $this->shouldThrow(\InvalidArgumentException::class)->during('handle', [$payload]);
    }

    public function it_should_have_payment_type()
    {
        $payload = ['type' => 'payment'];
        $this->handle($payload)->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Payment::class);
    }

    public function it_should_have_deposit_type()
    {
        $payload = [
            'type' => 'deposit',
            'status' => 'SUCCESS'
        ];

       $model =  $this->handle($payload);
       $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Deposit::class);

       $model->getStatus()->shouldBe('SUCCESS');
    }

    public function it_should_have_refund_type()
    {
        $payload = [
            'type' => 'refund',
            'operationId' => 123
        ];

        $model = $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Refund::class);
        $model->getOperationId()->shouldBe(123);
        $model->getData()->shouldBe([]);
    }
}
