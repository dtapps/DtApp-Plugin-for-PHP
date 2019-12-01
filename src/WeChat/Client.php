<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChat;

class Client
{
    /**
     * 公众号ID
     * @var mixed|string
     */
    private $appId = '';

    /**
     * 公众号密钥
     * @var mixed|string
     */
    private $appSecret = '';

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
     * 授权跳转
     * @param string $url
     * @param string $scope
     */
    public function HeaderOauth2(string $url, string $scope = 'snsapi_userinfo')
    {
        return (new WebApps([
            'appId' => $this->appId
        ]))->oauth2($url, $scope);
    }

    /**
     * 缩短网址
     * @param string $url
     * @param string $accessToken
     * @return bool
     */
    public function AcOunShortUrl(string $url, string $accessToken)
    {
        return (new AccOun())->shorturl($url, $accessToken);
    }
}
