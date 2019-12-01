<?php
/**
 * Name:LiGuAngChun
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Crypt;

/**
 * 小程序加密解密
 * Class MiniProgram
 * @package DtApp\Aes
 */
class MiniProgram extends Base
{
    /**
     * 密钥
     * @var string
     */
    private $key = '';

    /**
     * 密钥
     * @var string
     */
    private $iv = '';

    /**
     * 配置加密解密信息
     * MiniProgram constructor.
     * @param string $key 密钥
     * @param string $iv 密钥
     */
    public function __construct(string $key = '', string $iv = '')
    {
        if (!empty($key)) $this->key = $key;
        if (!empty($iv)) $this->iv = $iv;
    }

    /**
     * 加密
     * @param $data 数据
     * @return string
     */
    protected function encrypt($data)
    {
        try {
            if (!empty(is_array($data))) $data = json_encode($data);
            return urlencode(base64_encode(openssl_encrypt($data, 'AES-128-CBC', $this->key, 1, $this->iv)));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 解密
     * @param string $data 数据
     * @return string
     */
    protected function decrypt(string $data)
    {
        try {
            return openssl_decrypt(base64_decode(urldecode($data)), "AES-128-CBC", $this->key, true, $this->iv);
        } catch (\Exception $e) {
            return false;
        }
    }
}
