<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\AliPayMini;


class Client
{
    private $appId;

    private $appSecret;

    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
    }

    public function getToken($code)
    {
        return (new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret
        ]))->token($code);
    }

    public function getUserInfo($code)
    {
        return (new User([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret
        ]))->userInfo($this->getToken($code));
    }
}
