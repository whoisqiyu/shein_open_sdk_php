<?php

namespace shein\util;

use Exception;

class SignUtil
{
    const HMAC_SHA256 = "sha256";
    const RANDOM_LENGTH = 5;

    public static function buildSignHeader($appid, $openKey, $secretKey, $apiPath)
    {
        $timestamp = strval(time());
        $signString = $openKey . "&" . $timestamp . "&" . $apiPath;
        $randomKey = substr(str_replace('-', '', uniqid("", true)), 0, self::RANDOM_LENGTH);
        $hashValue = self::hmacSha256($signString, $secretKey . $randomKey);
        $base64Value = base64_encode($hashValue);
        $signature = $randomKey . $base64Value;
        $headers = [
            "x-lt-appid" => $appid,
            "x-lt-openKeyId" => $openKey,
            "x-lt-timestamp" => $timestamp,
            "x-lt-signature" => $signature
        ];
        return $headers;
    }

    public static function buildAppSignHeader($appid, $appSecretKey, $apiPath)
    {
        $timestamp = strval(time());
        $signString = $appid . "&" . $timestamp . "&" . $apiPath;
        $randomKey = substr(str_replace('-', '', uniqid("", true)), 0, self::RANDOM_LENGTH);
        $hashValue = self::hmacSha256($signString, $appSecretKey . $randomKey);
        $base64Value = base64_encode($hashValue);
        $signature = $randomKey . $base64Value;
        $headers = [
            "x-lt-appid" => $appid,
            "x-lt-timestamp" => $timestamp,
            "x-lt-signature" => $signature
        ];
        return $headers;
    }

    public static function sign($openKey, $secretKey, $apiPath, $timestamp)
    {
        $signString = $openKey . "&" . $timestamp . "&" . $apiPath;
        $randomKey = substr(md5(uniqid(mt_rand(), true)), 0, self::RANDOM_LENGTH);
        $hashValue = self::hmacSha256($signString, $secretKey . $randomKey);
        $base64Value = self::base64Encode($hashValue);
        return $randomKey . $base64Value;
    }

    private static function hmacSha256($message, $secret)
    {
        $mac = "";
        try {
            $mac = hash_hmac(self::HMAC_SHA256, $message, $secret);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        return $mac;
    }

    public static function base64Encode($data)
    {
        $result = "";
        if (!empty($data)) {
            $result = base64_encode($data);
        }
        return $result;
    }

    public static function verifySign($signature, $openKey, $secretKey, $requestPath, $timestamp)
    {
        $randomKey = substr($signature, 0, self::RANDOM_LENGTH);
        $signString = $openKey . "&" . $timestamp . "&" . $requestPath;
        $hashValue = self::hmacSha256($signString, $secretKey . $randomKey);
        $base64Value = $randomKey . self::base64Encode($hashValue);
        return $signature === $base64Value;
    }
}