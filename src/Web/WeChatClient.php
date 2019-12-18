<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Web;

use DtApp\Tool\DtAppException;
use DtApp\Web\WeChat\AccOun;
use DtApp\Web\WeChat\WebApps;

class WeChatClient
{
    /**
     * 公众号ID
     * @var mixed|string
     */
    private static $appId = '';

    /**
     * 公众号密钥
     * @var mixed|string
     */
    private static $appSecret = '';

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
     * 授权跳转
     * @param string $url
     * @param string $scope
     * @throws DtAppException
     */
    public static function HeaderOauth2(string $url, string $scope = 'snsapi_userinfo')
    {
        if (empty(self::$appId)) throw new DtAppException('请检查参数');
        return WebApps::oauth2(self::$appId, $url, $scope);
    }

    /**
     * 缩短网址
     * @param string $url
     * @param string $accessToken
     * @return bool
     * @throws DtAppException
     */
    public static function AcOunShortUrl(string $url, string $accessToken)
    {
        return AccOun::shortUrl($url, $accessToken);
    }
}
