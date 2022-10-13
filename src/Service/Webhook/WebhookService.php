<?php

namespace Oderopay\Service\Webhook;

use Oderopay\Model\Webhook\Payment;
use Oderopay\Model\Webhook\BaseWebhook;
use Oderopay\Service\BaseService;

class WebhookService extends BaseService
{

    public function handle(array $payload = [])
    {
        if(empty($payload) || !isset($payload['type'])) return new BaseWebhook();

        $className = str_replace("_", "", ucwords($payload['type'], "_"));
        $modelName = sprintf('\\Oderopay\\Model\\Webhook\\%s', $className);

        if(class_exists($modelName)){
            $model = new $modelName;
            $model->fromArray($payload);
            return $model;
        }

        throw new \InvalidArgumentException(sprintf('Class %s does not exists for callback type %s', $className, $payload['type']));

    }

}
