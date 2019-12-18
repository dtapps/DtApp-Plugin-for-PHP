<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\AliPayMini\AliPay;

use DtApp\MiniProgram\AliPayClient;
use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

/**
 * 中间件
 * Class Base
 * @package DtApp\AliPayMini\AliPayMini
 */
class Base extends AliPayClient
{
    /**
     * 接口网址
     * @var string
     */
    protected static $gateway_url = 'https://openapi.alipay.com/gateway.do';

    /**
     * 签名
     * @param string $data 数据
     * @param string $priKey 应用私钥
     * @return string
     */
    protected static function sign(string $data, string $priKey)
    {
        $str = $priKey;
        $str = chunk_split($str, 64, "\n");
        $private_key = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----\n";
        $binary_signature = "";
        openssl_sign($data, $binary_signature, $private_key, OPENSSL_ALGO_SHA256);
        return base64_encode($binary_signature);
    }

    /**
     * 发送前进行签名、排序
     * @param array $params
     * @param string $appSecret
     * @param string $name
     * @return bool
     * @throws DtAppException
     */
    protected static function aliPayHttp(array $params, string $appSecret, string $name)
    {
        ksort($params); //对将要签名的数组排序
        $string = Tool::urlToParams($params);// 将数组转换成字符串
        $params['sign'] = self::sign($string, $appSecret); //将字符串签名
        $params = http_build_query($params);
        $get_url = self::$gateway_url . "?$params";
        $http_get = Tool::reqGetHttp($get_url, '', true);;
        if (isset($http_get[$name])) return $http_get[$name];
        return false;
    }
}
