<?php
declare(strict_types=1);

namespace Oderopay\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Oderopay\Http\HttpClient;
use Oderopay\Http\HttpResponse;
use Oderopay\OderoClient;

class BaseService
{
    /**
     * @var OderoClient
     */
    public $client;
    /**
     * @var ClientInterface
     */
    public $http;

    public function __construct(OderoClient $client, HttpClient $http)
    {
        $this->client = $client;
        $this->http = $http;
    }

    /**
     * @param array $body
     * @param $merchantId
     * @param $merchantToken
     * @return string
     */
    public function generateMerchantSignature(array $body, $merchantId, $merchantToken): string
    {
        $merchantSignatureHeader = hash("sha256", $merchantId . json_encode($body) . $merchantToken);
        return sprintf('%s|%s', $merchantId, $merchantSignatureHeader);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return HttpResponse
     */
    public function request(string $method = 'POST', string $uri = '', array $options = [])
    {
        $merchantSignatureHeader = $this->generateMerchantSignature(
            $options['form_params'] ?? [],
            $this->client->config->getMerchantId(),
            $this->client->config->getMerchantToken()
        );

        $_options['headers'] = [
            'X-MERCHANT-SIGNATURE' => $merchantSignatureHeader,
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
        ];

        $options['headers'] = array_merge($options['headers'] ?? [], $_options['headers']);

        $uri = sprintf('%s/%s', $this->client->config->getApiHost(), $uri);

        try {
            $message = $this->http->request($method, $uri, $options);

            $response = new HttpResponse();
            $response->code = $message->getStatusCode();
            $response->content = $message->getBody()->getContents();
        }catch (\Exception $e ){
            $response = new HttpResponse();
            $error =  json_decode($e->getResponse()->getBody()->getContents(), true);
            $response->message = $error['message'] ?? $e->getMessage();
            $response->code = $e->getCode();
        }

        return $response;
    }
}
