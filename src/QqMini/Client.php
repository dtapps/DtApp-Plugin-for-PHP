<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\QqMini;

class Client
{
    private $appId = '';

    private $appSecret = '';

    private $tokenFile = '';

    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
        if (!empty($config['tokenFile'])) $this->tokenFile = $config['tokenFile'];
    }

    public function getCode2Session(string $jc_code = '')
    {
        return (new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret,
            'tokenFile' => $this->tokenFile,
        ]))->code2Session($jc_code);
    }

    public function getAccessToken()
    {
        return (new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret,
            'tokenFile' => $this->tokenFile,
        ]))->accessToken();
    }

    public function getUserInfo(string $js_code, string $encryptedData, string $iv)
    {
        return (new User())->userInfo($this->getCode2Session($js_code), $encryptedData, $iv);
    }
}
