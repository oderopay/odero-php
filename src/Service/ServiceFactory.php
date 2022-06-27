<?php

namespace Oderopay\Service;

use Oderopay\Service\Card\CardService;
use Oderopay\Service\Payment\PaymentService;

/**
 * Service factory class.
 * @property PaymentService $payments
 * @property CardService $cards
 */
class ServiceFactory extends AbstractServiceFactory
{
    /**
     * @var array<string, string>
     */
    private static $classMap = [
        'payments' => PaymentService::class,
        'cards' => CardService::class
    ];

    public function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
