<?php

namespace shein\util;

class AesUtil
{

    private static $DEFAULT_IV_SEED = "space-station-de";
    private static $CIPHER_ALGO = "AES-128-CBC";

    public static function decrypt($content, $key)
    {
        return openssl_decrypt(base64_decode($content), AesUtil::$CIPHER_ALGO,
            $key, OPENSSL_RAW_DATA, AesUtil::$DEFAULT_IV_SEED);
    }

}