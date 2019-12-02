<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\QqMini;

class Client
{
    /**
     * 小程序ID
     * @var mixed|string
     */
    private $appId = '';

    /**
     * 小程序密钥
     * @var mixed|string
     */
    private $appSecret = '';

    /**
     * 小程序token地址
     * @var mixed|string
     */
    private $tokenFile = '';

    /**
     * 配置
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
        if (!empty($config['tokenFile'])) $this->tokenFile = $config['tokenFile'];
    }

    /**
     * 取code2session
     * @param string $js_code
     * @return bool|mixed
     */
    public function getCode2Session(string $js_code = '')
    {
        return (new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret
        ]))->code2Session($js_code);
    }

    /**
     * 取token
     * @return bool
     */
    public function getAccessToken()
    {
        return (new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret,
            'tokenFile' => $this->tokenFile
        ]))->accessToken();
    }

    /**
     * 取用户信息
     * @param string $js_code
     * @param string $encryptedData
     * @param string $iv
     * @return bool|false|mixed|string
     */
    public function getUserInfo(string $js_code, string $encryptedData, string $iv)
    {
        return (new User())->userInfo((new Auth([
            'appId' => $this->appId,
            'appSecret' => $this->appSecret
        ]))->code2Session($js_code), $encryptedData, $iv);
    }
}
