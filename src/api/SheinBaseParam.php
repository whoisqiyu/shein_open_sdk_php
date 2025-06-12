<?php
namespace shein\api;

/**
 * Class SheinBaseParam
 * @package cn\dotfashion\open\api
 */
class SheinBaseParam {

    /**
     * @var string 供应商账户公钥
     */
    protected $openKeyId;

    /**
     * @var string 供应商账户密钥
     */
    protected $secretKey;

    /**
     * @var string 应用id
     */
    protected $appid;

    /**
     * @var string 应用秘钥
     */
    protected $appSecretKey;

    /**
     * @return string
     */
    public function getOpenKeyId()
    {
        return $this->openKeyId;
    }

    /**
     * @param string $openKeyId
     */
    public function setOpenKeyId($openKeyId)
    {
        $this->openKeyId = $openKeyId;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @param string $appid
     */
    public function setAppid($appid)
    {
        $this->appid = $appid;
    }

    /**
     * @return string
     */
    public function getAppSecretKey()
    {
        return $this->appSecretKey;
    }

    /**
     * @param string $appSecretKey
     */
    public function setAppSecretKey($appSecretKey)
    {
        $this->appSecretKey = $appSecretKey;
    }
}