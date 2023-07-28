<?php
declare(strict_types=1);

namespace Oderopay;

class OderoConfig
{

    const ENV_STG = 'stg';
    const ENV_PROD = 'prod';

    /** @var string */
    protected $merchantId;

    /** @var string */
    protected $merchantToken;

    /** @var string */
    protected $name;

    /** @var string */
    protected $env;

    /** @var string  */
    protected $apiHost;

    public function __construct($name, $merchantId, $merchantToken, $env = self::ENV_STG)
    {
        $this->name = $name;
        $this->merchantId = $merchantId;
        $this->merchantToken = $merchantToken;
        $this->env = $env;

        $this->apiHost = 'https://api-stg.pay.odero.ro';


        if($env === self::ENV_PROD) {
            $this->apiHost = 'https://pay.odero.ro';
        }

    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return mixed
     */
    public function getMerchantToken()
    {
        return $this->merchantToken;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @return string
     */
    public function getApiHost()
    {
        return $this->apiHost;
    }
}
