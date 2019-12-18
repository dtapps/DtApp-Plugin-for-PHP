<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\MiniProgram;

use DtApp\MiniProgram\QQ\Auth;
use DtApp\MiniProgram\QQ\User;
use DtApp\Tool\DtAppException;

/**
 * QQ小程序
 * Class QQClient
 * @package DtApp\MiniProgram
 */
class QQClient
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
     * @return bool|mixed
     * @throws DtAppException
     */
    public static function getCode2Session(string $js_code = '')
    {
        return Auth::code2Session(self::$appId, self::$appSecret, $js_code);
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
     * @return bool|false|mixed|string
     * @throws DtAppException
     */
    public static function getUserInfo(string $js_code, string $encryptedData, string $iv)
    {
        return User::userInfo(Auth::code2Session(self::$appId, self::$appSecret, $js_code), $encryptedData, $iv);
    }
}
