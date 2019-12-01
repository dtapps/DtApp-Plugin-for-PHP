<?php
/**
 * Name:LiGuAngChun
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

    public function __construct(array $config = [])
    {
        if (!empty($config['key'])) $this->key = $config['key'];
        if (!empty($config['iv'])) $this->iv = $config['iv'];
    }

    /**
     * 微信小程序加密
     * @param $data
     * @return string
     */
    public function wxXcxEncrypt($data)
    {
        return (new MiniProgram($this->key, $this->iv))->encrypt($data);
    }

    /**
     * 微信小程序解密
     * @param $data
     * @return string
     */
    public function wxXcxDecrypt(string $data)
    {
        return (new MiniProgram($this->key, $this->iv))->decrypt($data);
    }
}
