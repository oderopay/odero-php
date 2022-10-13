<?php

namespace spec\Oderopay\Service\Webhook;

use Oderopay\OderoClient;
use Oderopay\Service\BaseService;
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
        $payload = file_get_contents(OderoClient::APP_DIR . "/stubs/webhook/payment.json");
        $payload = json_decode($payload, true);

        $model = $this->handle($payload);

        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Payment::class);

        $model->isDepositMade()->shouldBe(false);
        $model->getCardToken()->shouldBe(null);
        $model->getLastFourDigits()->shouldBe(null);
        $model->getExpirationMonth()->shouldBe(null);
        $model->getExpirationYear()->shouldBe(null);

    }

    public function it_should_have_deposit_type()
    {

        $payload = file_get_contents(OderoClient::APP_DIR . "/stubs/webhook/deposit.json");
        $payload = json_decode($payload, true);

        $model =  $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Deposit::class);

        $model->getStatus()->shouldBe('SUCCESS');

        $model->getPaymentId()->shouldBe('9e60d19a-62e0-4d6a-a482-922ff6f01933');
        $model->getPaymentOperationId()->shouldBe('1ed4a34b-79a1-6fee-ad98-e794f89a217a');
        $model->getAmount()->shouldBe('50.88');
    }

    public function it_should_have_refund_type()
    {

        $payload = file_get_contents(OderoClient::APP_DIR . "/stubs/webhook/refund.json");
        $payload = json_decode($payload, true);

        $model = $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Refund::class);
        $model->getOperationId()->shouldBe('1ed4a34f-60c8-687a-a14d-d53acf3cde4e');
        $model->getData()->shouldBeArray();
        $model->getPaymentId()->shouldBe('9e60d19a-62e0-4d6a-a482-922ff6f01933');
        $model->getPaymentOperationId()->shouldBe('1ed4a34b-79a1-6fee-ad98-e794f89a217a');
        $model->getAmount()->shouldBe('50.88');
    }

    public function it_should_have_reverse_type()
    {

        $payload = file_get_contents(OderoClient::APP_DIR . "/stubs/webhook/reverse.json");
        $payload = json_decode($payload, true);

        $model = $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\Reverse::class);
        $model->getOperationId()->shouldBe('1ed4a34f-60c8-687a-a14d-d53acf3cde4e');
        $model->getPaymentId()->shouldBe('9e60d19a-62e0-4d6a-a482-922ff6f01933');
        $model->getPaymentOperationId()->shouldBe('1ed4a34b-79a1-6fee-ad98-e794f89a217a');
        $model->getAmount()->shouldBe('50.88');
    }

    public function it_should_have_stored_card_type()
    {

        $payload = file_get_contents(OderoClient::APP_DIR . "/stubs/webhook/stored_card.json");
        $payload = json_decode($payload, true);

        $model = $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\StoredCard::class);
        $model->getOperationId()->shouldBe('1ed4ac06-eb95-6a6a-89fb-9b562db4a5db');
        $model->getCardToken()->shouldBe('sample token');
        $model->getLastFourDigits()->shouldBe('7499');
        $model->getExpirationMonth()->shouldBe(4);
        $model->getExpirationYear()->shouldBe(2023);

    }
    public function it_should_have_remove_stored_card_type()
    {

        $payload = file_get_contents(OderoClient::APP_DIR . "/stubs/webhook/remove_stored_card.json");
        $payload = json_decode($payload, true);

        $model = $this->handle($payload);
        $model->shouldBeAnInstanceOf(\Oderopay\Model\Webhook\RemoveStoredCard::class);
        $model->getOperationId()->shouldBe('1ed4ade7-c4a0-6d00-a09b-ed7e63f1aa16');
        $model->getCardToken()->shouldBe('card token will be here');

    }
}
