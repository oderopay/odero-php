<?php

namespace Oderopay\Service;

use Oderopay\Service\Payment\PaymentService;

/**
 * Service factory class.
 * @property PaymentService $payments
 */
class ServiceFactory extends AbstractServiceFactory
{
    /**
     * @var array<string, string>
     */
    private static $classMap = [
        'payments' => PaymentService::class,
    ];

    public function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
