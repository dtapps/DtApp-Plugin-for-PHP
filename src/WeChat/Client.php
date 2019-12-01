<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChat;

class Client
{
    private $appId = '';

    private $appSecret = '';

    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
    }

    public function HeaderOauth2(string $url, string $scope = 'snsapi_userinfo')
    {
        return (new WebApps([
            'appId' => $this->appId
        ]))->oauth2($url, $scope);
    }

    public function AcOunShortUrl(string $url, string $accessToken)
    {
        return (new Accoun())->shorturl($url, $accessToken);
    }
}
