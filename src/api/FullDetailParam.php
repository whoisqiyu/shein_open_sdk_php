<?php

namespace shein\api;

/**
 * Class FullDetailParam
 * @package cn\dotfashion\open\api
 */
class FullDetailParam extends SheinBaseParam
{
    /**
     * @var array sku code, 最大个数100
     */
    public $skuCodes;
    /**
     * @var string, 默认: zh-cn
     */
    public $language;

    public function getSkuCodes()
    {
        return $this->skuCodes;
    }

    public function setSkuCodes($skuCodes)
    {
        $this->skuCodes = $skuCodes;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

}