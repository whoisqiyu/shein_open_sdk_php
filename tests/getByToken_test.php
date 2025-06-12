<?php

require '../include.php';

use openapi\api\GetByTokenParam;
use openapi\client\GetByTempTokenClient;
use openapi\util\AesUtil;

$appid = '10ADAAB4CE003B319FCF40B8C4BE5';
$appSecretKey = '7DEB7CEC96814DA09C444E4049E3BD29';
$tempToken = "d4d6d8e9-b8d6-41db-903d-dc77f045bfd7";

$getByToken = new GetByTokenParam();
$getByToken->setTempToken($tempToken);
$getByToken->setAppid($appid);
$getByToken->setAppSecretKey($appSecretKey);
$getByTempTokenClient = new GetByTempTokenClient();

// POST请求/open-api/auth/get-by-token接口
$getByTokenResultStr = $getByTempTokenClient->getByTempToken($getByToken);
$getByTokenResult = json_decode($getByTokenResultStr);

if ($getByTokenResult->code != 0) {
    echo 'getByToken error:' . $getByTokenResultStr;
    return;
}

// 解密secretKey
echo '解密后的sk:' . AesUtil::decrypt($getByTokenResult->info->secretKey, $appSecretKey);