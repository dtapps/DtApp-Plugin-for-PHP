<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChatMini;

/**
 * 微信小程序
 * Class Client
 * @package DtApp\WeChatMini
 */
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
     * @return bool|mixed|string
     */
    public function getCode2Session(string $js_code)
    {
        return (new Auth())->code2Session($this->appId, $this->appSecret, $js_code);
    }

    /**
     * @param string $openid
     * @param string $transaction_id
     * @param string $access_token
     * @return bool|mixed|string
     */
    public function getPaidUnionIdTI(string $openid, string $transaction_id, string $access_token)
    {
        return (new Auth())->paidUnionIdTI($openid, $transaction_id, $access_token);
    }

    /**
     * @param string $openid
     * @param string $mch_id
     * @param string $out_trade_no
     * @param string $access_token
     * @return bool|mixed|string
     */
    public function getPaidUnionIdOM(string $openid, string $mch_id, string $out_trade_no, string $access_token)
    {
        return (new Auth())->paidUnionIdOM($openid, $mch_id, $out_trade_no, $access_token);
    }

    /**
     * 取token
     * @return bool
     */
    public function getAccessToken()
    {
        return (new Auth())->accessToken($this->appId, $this->appSecret, $this->tokenFile);
    }

    /**
     * 取用户信息
     * @param string $js_code
     * @param string $encryptedData
     * @param string $iv
     * @return false|mixed|string
     */
    public function getUserInfo(string $js_code, string $encryptedData, string $iv)
    {
        return (new User())->userInfo($this->appId, $this->appSecret, $js_code, $encryptedData, $iv);
    }
}
