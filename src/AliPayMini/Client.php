<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\AliPayMini;

/**
 * 支付宝小程序
 * Class Client
 * @package DtApp\AliPayMini
 */
class Client
{
    /**
     * 小程序ID
     * @var mixed
     */
    private $appId;

    /**
     * 小程序密钥
     * @var mixed
     */
    private $appSecret;

    /**
     * 配置
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
    }

    /**
     * 取token
     * @param $code
     * @return bool
     */
    public function getToken($code)
    {
        return (new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret
        ]))->token($code);
    }

    /**
     * 取用户信息
     * @param $code
     * @return bool
     */
    public function getUserInfo($code)
    {
        return (new User([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret
        ]))->userInfo($this->getToken($code));
    }
}
