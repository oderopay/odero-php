<?php
declare(strict_types=1);

namespace Oderopay\Http;


use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClient
{
    /**
     * @var HttpClientInterface
     */
    public $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
	 * @throws HttpExceptionInterface|\Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
	 */
    public function request($method = 'POST', $uri = '', $options = [])
    {
        $options['json'] = $options['form_params'] ?? []; unset($options['form_params']);

        if(method_exists($this->client, 'createRequest')){
            return $this->client->send($this->client->createRequest($method, $uri, $options));
		}

        return $this->client->request($method, $uri, $options);
    }
}
