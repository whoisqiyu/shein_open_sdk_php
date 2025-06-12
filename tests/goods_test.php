<?php

require '../include.php';

use openapi\api\FullDetailParam;
use openapi\client\GoodsClient;

// 商品详情查询（新）(https://open.sheincorp.com/documents/apidoc/detail/3000089-1000001)
$fullDetailParam = new FullDetailParam();
$fullDetailParam->setSkuCodes(array('I4eh8m7bdl0c'));
$fullDetailParam->setLanguage('zh-cn');
$fullDetailParam->setOpenKeyId('9A31FC969D3F496F84125162AECF4AEB');
$fullDetailParam->setSecretKey('0B8010061024435CBA9A7C649EB970C4');
$goodsClient = new GoodsClient();
echo $goodsClient->fullDetail($fullDetailParam);