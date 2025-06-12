<?php
namespace shein\api;

/**
 * Class GetByTokenParam
 * @package cn\dotfashion\open\api
 */
class GetByTokenParam extends SheinBaseParam  {

    /**
     * @var string 临时密钥
     */
    public $tempToken;

    /**
     * @return string
     */
    public function getTempToken()
    {
        return $this->tempToken;
    }

    /**
     * @param string $tempToken
     */
    public function setTempToken($tempToken)
    {
        $this->tempToken = $tempToken;
    }
}