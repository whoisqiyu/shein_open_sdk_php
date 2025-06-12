<?php

namespace shein\client;

use openapi\util\SignUtil;
use openapi\util\TimeUtil;

class SheinClient
{

    private $domain = 'https://openapi-test01.sheincorp.cn';
    //  private $domain = "https://openapi.sheincorp.com";
    //  private $domain = "https://openapi.sheincorp.cn";

    public function postByAppSign($path, $data) {
        $timestamp = TimeUtil::currentTimeMillis();
        $appid = $data->getAppid();
        $sign = SignUtil::sign($appid, $data->getAppSecretKey(), $path, $timestamp);
        $headers = [
            "language" => $data->getLanguage(),
            "x-lt-appid" => $appid,
            "x-lt-timestamp" => $timestamp,
            "x-lt-signature" => $sign
        ];
        return $this->post($path, $data, $headers);
    }

    public function postByOpenKeySign($path, $data) {
        $timestamp = TimeUtil::currentTimeMillis();
        $openKeyId = $data->getOpenKeyId();
        $sign = SignUtil::sign($openKeyId, $data->getSecretKey(), $path, $timestamp);
        $headers = [
            "language" => $data->getLanguage(),
            "x-lt-openKeyId" => $openKeyId,
            "x-lt-timestamp" => $timestamp,
            "x-lt-signature" => $sign
        ];
        return $this->post($path, $data, $headers);
    }

    /**
     * 发起GET请求
     *
     * @param string $path 请求的URL
     * @param array $params 请求的参数
     * @param array $headers 请求的头部信息
     * @return string 响应内容
     */
    public function get($path, $params = [], $headers = [])
    {
        // 拼接参数到URL
        if (!empty($params)) {
            $path .= '?' . http_build_query($params);
        }

        // 初始化cURL会话
        $curl = curl_init($this->domain . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->formatHeaders($headers));

        // 执行cURL会话
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * 发送 POST 请求
     *
     * @param string $path 请求的URL
     * @param object | array $data POST请求的数据
     * @param array $headers 请求头
     * @return string 响应内容
     */
    public function post($path, $data, $headers = [])
    {
        $curl = curl_init($url = $this->domain . $path);
        // 设置cURL选项
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data = json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge(['Content-Type: application/json'], $this->formatHeaders($headers)));

       // echo 'POST请求地址：' . $url . PHP_EOL;
      //  echo '请求header：' . json_encode($headers) . PHP_EOL;
       // echo '请求参数：' . $data . PHP_EOL;
        // 执行cURL会话
        $response = curl_exec($curl);
      //  echo 'response：' . $response . PHP_EOL;
        curl_close($curl);

        return $response;
    }

    /**
     * 格式化请求头
     *
     * @param array $headers 请求头数组
     * @return array 格式化后的请求头数组
     */
    protected function formatHeaders($headers)
    {
        $formattedHeaders = [];
        foreach ($headers as $key => $value) {
            $formattedHeaders[] = "{$key}: {$value}";
        }

        return $formattedHeaders;
    }
}
