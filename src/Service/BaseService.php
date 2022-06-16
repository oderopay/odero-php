<?php
declare(strict_types=1);

namespace Oderopay\Service;

use Oderopay\OderoClient;

class BaseService
{
    public function __construct(OderoClient $client)
    {
        $this->client = $client;
    }
}
