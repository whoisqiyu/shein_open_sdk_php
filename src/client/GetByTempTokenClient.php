<?php

namespace shein\client;

class GetByTempTokenClient extends SheinClient {

    public $path = '/open-api/auth/get-by-token';

    public function getByTempToken($param){
        return $this->postByAppSign($this->path, $param);
    }
}