<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Crypt\Aes;


use DtApp\Crypt\AesClient;

use Exception;

class Base extends AesClient
{
    /**
     * 加密
     * @param $key
     * @param $iv
     * @param array|string $data 数据
     * @return string
     */
    protected static function _encrypt($key, $iv, $data)
    {
        try {
            if (!empty(is_array($data))) $data = json_encode($data);
            return urlencode(base64_encode(openssl_encrypt($data, 'AES-128-CBC', $key, 1, $iv)));
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 解密
     * @param $key
     * @param $iv
     * @param string $data 数据
     * @return string
     */
    protected static function _decrypt($key, $iv, string $data)
    {
        try {
            return openssl_decrypt(base64_decode(urldecode($data)), "AES-128-CBC", $key, true, $iv);
        } catch (Exception $e) {
            return false;
        }
    }
}
