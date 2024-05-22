<?php
declare(strict_types=1);

namespace Oderopay\Http;


use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClient
{
    /**
     * @var HttpClientInterface
     */
    public HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
	 * @throws HttpExceptionInterface|\Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
	 */
    public function request($method = 'POST', $uri = '', $options = []) : ResponseInterface
    {
        $options['json'] = $options['form_params'] ?? []; unset($options['form_params']);

        if(method_exists($this->client, 'createRequest')){
            return $this->client->send($this->client->createRequest($method, $uri, $options));
		}

        return $this->client->request($method, $uri, $options);
    }
}
