<?php
declare(strict_types=1);

namespace Oderopay\Model;

use Oderopay\Traits\FromArrayTrait;
use Oderopay\Traits\SerializerTrait;

abstract class AbstractRequest
{
    use SerializerTrait, FromArrayTrait;

    public function generateMerchantSignature($body, $merchantId, $merchantToken)
    {
        $merchantSignatureHeader = hash("sha256", $merchantId . json_encode($body) . $merchantToken);
        return sprintf('%s|%s', $merchantId, $merchantSignatureHeader);
    }
}
