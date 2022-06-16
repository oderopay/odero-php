<?php
declare(strict_types=1);

namespace Oderopay\Service;

use Oderopay\OderoClientInterface;

abstract class AbstractServiceFactory
{
    /** @var OderoClientInterface */
    private $client;

    /** @var array<string, AbstractServiceFactory> */
    private $services;

    /**
     * @param OderoClientInterface $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->services = [];
    }

    abstract protected function getServiceClass($name);

    public function getClient()
    {
        return $this->client;
    }

    public function __get($name)
    {
        $serviceClass = $this->getServiceClass($name);
        if (null !== $serviceClass) {
            if (!\array_key_exists($name, $this->services)) {
                $this->services[$name] = new $serviceClass($this->getClient());
            }

            return $this->services[$name];
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }
}
