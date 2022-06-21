<?php
declare(strict_types=1);

namespace Tests;

use Oderopay\Http\HttpClient;
use PHPUnit\Framework\TestCase;

class OderoTestCase extends TestCase
{
    protected $json = '{}';

    protected function setUp() : void
    {
        parent::setUp();

        $this->httpClient = $this->getMockBuilder('HttpClient')
            ->setMethods(array("request","get", "getV2","post", "put", "delete", "exchange"))
            ->getMock();
    }

    protected function expectHttpClient($method)
    {
        $this->httpClient->expects($this->once())
            ->method($method)
            ->withAnyParameters()
            ->willReturn($this->json);
    }
}
