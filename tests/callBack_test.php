<?php

require '../include.php';

use openapi\util\AesUtil;
use openapi\util\SignUtil;

// 用作示例，关注回调验签和解密，运行会报错

// app的密钥
$appSecretKey = "";
// 你的回调地址
$callBackPath = "";
$openKeyId = request()->header("x-lt-openKeyId");
$eventCode = request()->header("x-lt-eventCode");
$appid = request()->header("x-lt-appid");
$timestamp = request()->header("x-lt-timestamp");
$signature = request()->header("x-lt-signature");

$verify = SignUtil::verifySign($signature, $appid, $appSecretKey, $callBackPath, $timestamp);
if (!$verify) {
    echo '收到openAPI-callback请求，签名错误-' . $verify;
    return;
}

$eventData = request()->post();
$decrypt = AesUtil::decrypt("K/VQXyJUVXtt1XXUUIE6p/xS7mE5KpIkdRPOcXvjgfSCyhRfcMCL43FJ1KZ4qp5TA2DEBZvOZscxdbkRf2jxig==", "BA5CCA3C2D8C4D71AD0CE7916A21F1D9");


