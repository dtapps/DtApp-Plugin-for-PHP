<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\MiniProgram;


use DtApp\AliPayMini\AliPay\Auth;
use DtApp\AliPayMini\AliPay\User;
use DtApp\Tool\DtAppException;

/**
 * 支付宝小程序
 * Class AliPayClient
 * @package DtApp\MiniProgram
 */
class AliPayClient
{
    /**
     * 小程序ID
     * @var mixed
     */
    private static $appId;

    /**
     * 小程序密钥
     * @var mixed
     */
    private static $appSecret;

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig(array $config = [])
    {
        if (!empty($config['appId'])) self::$appId = $config['appId'];
        if (!empty($config['appSecret'])) self::$appSecret = $config['appSecret'];
    }

    /**
     * 取token
     * @param string $code
     * @return bool
     * @throws DtAppException
     */
    public static function getToken(string $code)
    {
        return Auth::token(self::$appId, self::$appSecret, $code);
    }

    /**
     * 取用户信息
     * @param string $code
     * @return bool
     * @throws DtAppException
     */
    public static function getUserInfo(string $code)
    {
        return User::userInfo(self::$appId, self::$appSecret, self::getToken($code));
    }
}
