<?php

namespace shein\client;

class GoodsClient extends SheinClient {

    private $fullDetailPath = '/open-api/openapi-business-backend/product/full-detail';

    public function fullDetail($param){
        return $this->postByOpenKeySign($this->fullDetailPath, $param);
    }

}