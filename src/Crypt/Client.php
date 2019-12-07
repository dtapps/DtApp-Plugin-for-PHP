<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Crypt;

/**
 * 加密解密模块
 * Class Client
 * @package DtApp\Crypt
 */
class Client
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
     * 配置
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['key'])) $this->key = $config['key'];
        if (!empty($config['iv'])) $this->iv = $config['iv'];
    }

    /**
     * Aes加密
     * @param array|string $data 数据
     * @return string
     */
    public function aesEncrypt($data)
    {
        return (new Aes($this->key, $this->iv))->encrypt($data);
    }

    /**
     * Aes解密
     * @param string $data
     * @return string
     */
    public function aesDecrypt(string $data)
    {
        return (new Aes($this->key, $this->iv))->decrypt($data);
    }

    /**
     * 微信小程序加密
     * @param array|string $data 数据
     * @return string
     */
    public function wxXcxEncrypt($data)
    {
        return (new MiniProgram($this->key, $this->iv))->encrypt($data);
    }

    /**
     * 微信小程序解密
     * @param string $data
     * @return string
     */
    public function wxXcxDecrypt(string $data)
    {
        return (new MiniProgram($this->key, $this->iv))->decrypt($data);
    }
}
