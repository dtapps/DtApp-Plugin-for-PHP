<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/8
 * Time: 0:44
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\AliPayMini;

/**
 * 支付宝小程序
 * Class Base
 * @package DtApp\AliPayMini
 */
class Base
{
    /**
     * Get请求
     * @param $url
     * @param null $data
     * @return mixed
     */
    protected function get_http($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output, true);
    }

    /**
     * 签名
     * @param string $data 数据
     * @param string $priKey 应用私钥
     * @return string
     */
    protected function sign($data, $priKey)
    {
        $str = $priKey;
        $str = chunk_split($str, 64, "\n");
        $private_key = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----\n";
        $binary_signature = "";
        openssl_sign($data, $binary_signature, $private_key, OPENSSL_ALGO_SHA256);
        $sign = base64_encode($binary_signature);
        return $sign;
    }

    /**
     * 格式化参数格式化成url参数
     * @param $param
     * @return string
     */
    protected function toUrlParam($param)
    {
        $buff = "";
        foreach ($param as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
}
