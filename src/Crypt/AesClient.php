<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Crypt;


use DtApp\Crypt\Aes\Base;

class AesClient
{
    /**
     * 密钥
     * @var string
     */
    private static $key = '';

    /**
     * 密钥
     * @var string
     */
    private static $iv = '';

    /**
     * 配置
     * @param array $array
     */
    public static function setConfig(array $array = [])
    {
        if (!empty($array['key'])) self::$key = $array['key'];
        if (!empty($array['iv'])) self::$iv = $array['iv'];
    }

    /**
     * 加密
     * @param $data
     * @return string
     */
    public static function encrypt($data)
    {
        return Base::_encrypt(self::$key, self::$iv, $data);
    }

    /**
     * 解密
     * @param string $data
     * @return string
     */
    public static function decrypt(string $data)
    {
        return Base::_decrypt(self::$key, self::$iv, $data);
    }
}
