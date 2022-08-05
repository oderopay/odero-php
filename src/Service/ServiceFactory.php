<?php

namespace Oderopay\Service;

use Oderopay\Service\Card\CardService;
use Oderopay\Service\Payment\PaymentService;
use Oderopay\Service\Payment\SubscriptionService;
use Oderopay\Service\Webhook\WebhookService;

/**
 * Service factory class.
 * @property PaymentService $payments
 * @property CardService $cards
 * @property SubscriptionService $subscriptions
 * @property WebhookService $webhooks
 */
class ServiceFactory extends AbstractServiceFactory
{
    /**
     * @var array<string, string>
     */
    private static $classMap = [
        'payments' => PaymentService::class,
        'cards' => CardService::class,
        'subscriptions' => SubscriptionService::class,
        'webhooks' => WebhookService::class
    ];

    public function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
