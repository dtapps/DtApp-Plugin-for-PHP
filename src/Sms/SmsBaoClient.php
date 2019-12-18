<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Sms;

use DtApp\Sms\SmsBao\Query;
use DtApp\Sms\SmsBao\Send;
use DtApp\Tool\DtAppException;

/**
 * 短信宝
 * Class SmsBaoClient
 * @package DtApp\Sms
 */
class SmsBaoClient
{
    /**
     * 平台账号
     * @var mixed|string
     */
    private static $user = '';

    /**
     * 平台密码
     * @var mixed|string
     */
    private static $pass = '';

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig(array $config = [])
    {
        if (!empty($config['user'])) self::$user = $config['user'];
        if (!empty($config['pass'])) self::$pass = $config['pass'];
    }

    /**
     * 发送国内验证码
     * @param int $iphone 手机号码
     * @param int|string $code 验证码
     * @param string $template 模板
     * @param string $rep 替换
     * @return mixed
     * @throws DtAppException
     */
    public static function sendSms(int $iphone, $code, string $template, string $rep)
    {
        if (empty(self::$user) || empty(self::$pass)) throw new DtAppException('请检查参数');
        return Send::sms(self::$user, self::$pass, $iphone, $code, $template, $rep);
    }

    /**
     * 获取当前账号余额
     * @return bool|false|string
     * @throws DtAppException
     */
    public static function queryBalance()
    {
        if (empty(self::$user) || empty(self::$pass)) throw new DtAppException('请检查参数');
        return Query::balance(self::$user, self::$pass);
    }
}
