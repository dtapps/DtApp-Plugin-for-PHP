<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\MiniProgram;


use DtApp\MiniProgram\WeChat\Auth;
use DtApp\MiniProgram\WeChat\User;
use DtApp\Tool\DtAppException;

/**
 * 微信小程序
 * Class WeChatClient
 * @package DtApp\MiniProgram
 */
class WeChatClient
{
    /**
     * 小程序ID
     * @var mixed|string
     */
    private static $appId = '';

    /**
     * 小程序密钥
     * @var mixed|string
     */
    private static $appSecret = '';

    /**
     * 小程序token地址
     * @var mixed|string
     */
    private static $tokenFile = '';

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig(array $config = [])
    {
        if (!empty($config['appId'])) self::$appId = $config['appId'];
        if (!empty($config['appSecret'])) self::$appSecret = $config['appSecret'];
        if (!empty($config['tokenFile'])) self::$tokenFile = $config['tokenFile'];
    }

    /**
     * 取code2session
     * @param string $js_code
     * @return bool|mixed|string
     * @throws DtAppException
     */
    public static function getCode2Session(string $js_code)
    {
        return Auth::code2Session(self::$appId, self::$appSecret, $js_code);
    }

    /**
     * @param string $openid
     * @param string $transaction_id
     * @param string $access_token
     * @return bool|mixed|string
     * @throws DtAppException
     */
    public static function getPaidUnionIdTI(string $openid, string $transaction_id, string $access_token)
    {
        return Auth::paidUnionIdTI($openid, $transaction_id, $access_token);
    }

    /**
     * @param string $openid
     * @param string $mch_id
     * @param string $out_trade_no
     * @param string $access_token
     * @return bool|mixed|string
     * @throws DtAppException
     */
    public static function getPaidUnionIdOM(string $openid, string $mch_id, string $out_trade_no, string $access_token)
    {
        return Auth::paidUnionIdOM($openid, $mch_id, $out_trade_no, $access_token);
    }

    /**
     * 取token
     * @return bool
     * @throws DtAppException
     */
    public static function getAccessToken()
    {
        return Auth::accessToken(self::$appId, self::$appSecret, self::$tokenFile);
    }

    /**
     * 取用户信息
     * @param string $js_code
     * @param string $encryptedData
     * @param string $iv
     * @return false|mixed|string
     * @throws DtAppException
     */
    public static function getUserInfo(string $js_code, string $encryptedData, string $iv)
    {
        return User::userInfo(self::$appId, self::$appSecret, $js_code, $encryptedData, $iv);
    }
}
