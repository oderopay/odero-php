<?php
declare(strict_types=1);

namespace Oderopay\Service;

use Oderopay\Http\HttpClient;
use Oderopay\Http\HttpResponse;
use Oderopay\OderoClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;

class BaseService
{
    /**
     * @var OderoClient
     */
    public $client;
    /**
     * @var HttpExceptionInterface
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

		$response = new HttpResponse();

        try {
            $message = $this->http->request($method, $uri, $options);
            $response->code = $message->getStatusCode();
            $response->content = $message->toArray();
        }catch (ClientExceptionInterface $e){
            $error =  $e->getResponse()->toArray(false);
            $response->message = $error;
            $response->code = $e->getCode();
        }catch (\Exception $e){
            $response->message = $e->getMessage();
            $response->code = $e->getCode();
        }

        return $response;
    }
}
