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
        $_options = [
            'form_params' => []
        ];

        if(isset($options['form_params'])){
            $_options['form_params'] = array_merge($_options['form_params'], $options['form_params']);
        }

        $_options['headers'] = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
        ];

        if(isset($options['headers'])){
            $_options['headers'] = array_merge($_options['headers'], $options['headers']);
        }

        return $this->client->request($method, $uri, $_options);
    }
}
