<?php
declare(strict_types=1);

namespace Oderopay\Service;

use Oderopay\Http\HttpClient;
use Oderopay\OderoClientInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractServiceFactory
{
    /** @var OderoClientInterface */
    private OderoClientInterface $client;

    /** @var array<string, AbstractServiceFactory> */
    private array $services;

    /**
     * @param OderoClientInterface $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->services = [];
    }

    abstract protected function getServiceClass($name);

    public function getClient(): OderoClientInterface
	{
        return $this->client;
    }

	public function makeHttpClient(): HttpClientInterface
	{

		$client = \Symfony\Component\HttpClient\HttpClient::create();

		$client->withOptions([
			'base_uri' => $this->getClient()->config->getApiHost(),
			'headers' => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
			],
		]);

		return  $client;

	}

    public function __get($name)
    {
        $serviceClass = $this->getServiceClass($name);
        if (null !== $serviceClass) {
            if (!\array_key_exists($name, $this->services)) {
                $httpClient = $this->makeHttpClient();
                $this->services[$name] = new $serviceClass($this->getClient(), new HttpClient($httpClient));
            }

            return $this->services[$name];
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }
}
