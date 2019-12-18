<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\AliPayMini\AliPay;

use DtApp\Tool\DtAppException;

/**
 * 授权
 * Class Auth
 * @package DtApp\AliPayMini\AliPayMini
 */
class Auth extends Base
{
    /**
     * 仅支持JSON
     * @var string
     */
    private static $format = 'json';

    /**
     * 请求使用的编码格式，如utf-8,gbk,gb2312等
     * @var string
     */
    private static $post_charset = 'UTF-8';

    /**
     *  商户生成签名字符串所使用的签名算法类型，目前支持RSA2和RSA，推荐使用RSA2
     * @var string
     */
    private static $sign_type = 'RSA2';

    /**
     * 调用的接口版本
     * @var string
     */
    private static $api_version = '1.0';


    /**
     * 换取授权访问令牌
     * https://docs.open.alipay.com/api_9/alipay.system.oauth.token/
     * Array
     * (
     * [access_token] => 访问令牌。通过该令牌调用需要授权类接口 authbseBd4fbf781a00b43499d84747cfe324X20
     * [alipay_user_id] => 20881072656705515503611382012020
     * [expires_in] => 访问令牌的有效时间，单位是秒。 31536000
     * [re_expires_in] => 刷新令牌的有效时间，单位是秒。  31536000
     * [refresh_token] => 刷新令牌。通过该令牌可以刷新access_token authbseBb3941249aa37467698ece60996338X20
     * [user_id] => 支付宝用户的唯一userId 2088212587578201
     * )
     * @param string $appId
     * @param string $appSecret
     * @param string $code
     * @return bool
     * @throws DtAppException
     */
    protected static function token(string $appId, string $appSecret, string $code)
    {
        $timestamp = date("Y-m-d H:i:s");
        $params['app_id'] = $appId;
        $params['method'] = 'alipay.system.oauth.token';
        $params['format'] = self::$format;
        $params['charset'] = self::$post_charset;
        $params['sign_type'] = self::$sign_type;
        $params['timestamp'] = $timestamp;
        $params['version'] = self::$api_version;
        $params['grant_type'] = "authorization_code";
        $params['code'] = $code;
        return self::aliPayHttp($params, $appSecret, 'alipay_system_oauth_token_response');
    }
}
