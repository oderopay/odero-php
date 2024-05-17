<?php
declare(strict_types=1);

namespace Oderopay;

use Oderopay\Service\Card\CardService;
use Oderopay\Service\Payment\PaymentService;
use Oderopay\Service\Payment\SubscriptionService;
use Oderopay\Service\ServiceFactory;
use Oderopay\Service\Webhook\WebhookService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Oderopay client class.
 * @property PaymentService $payments
 * @property CardService $cards
 * @property SubscriptionService $subscriptions
 * @property WebhookService $webhooks
 */
class OderoClient implements OderoClientInterface
{
    const VERSION = '1.0.0';

    const APP_DIR = __DIR__ .'/../';

    /** @var ServiceFactory */
    protected $serviceFactory;

    /** @var OderoConfig */
    public $config;

    /** @var HttpClientInterface */
    public $http;

    public function __construct(OderoConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param $name
     * @return mixed|Service\AbstractServiceFactory|null
     */
    public function __get($name)
    {
        if (null === $this->serviceFactory) {
            $this->serviceFactory = new ServiceFactory($this);
        }

        return $this->serviceFactory->__get($name);
    }

}
