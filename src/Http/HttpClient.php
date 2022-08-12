<?php
declare(strict_types=1);

namespace Oderopay\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class HttpClient
{
    /**
     * @var Client
     */
    public $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method = 'POST', $uri = '', $options = [])
    {
        $options['json'] = $options['form_params'] ?? []; unset($options['form_params']);

        //guzzle 5+ compatibility
        if(method_exists($this->client, 'createRequest')){
            return $this->client->send($this->client->createRequest($method, $uri, $options));
        }

        return $this->client->request($method, $uri, $options);
    }
}
