<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\AliPayMini\AliPay;

use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

/**
 * 用户
 * Class User
 * @package DtApp\AliPayMini\AliPayMini
 */
class User extends Base
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
     * 调用的接口版本
     * @var string
     */
    private static $api_version = '1.0';

    /**
     *  商户生成签名字符串所使用的签名算法类型，目前支持RSA2和RSA，推荐使用RSA2
     * @var string
     */
    private static $sign_type = 'RSA2';

    /**
     * 支付宝会员授权信息查询接口
     * https://docs.open.alipay.com/api_2/alipay.user.info.share
     * Array
     * (
     * [code] => 10000
     * [msg] => Success
     * [avatar] => 用户头像地址 https://tfs.alipayobjects.com/images/partner/TB1qktca8WiDuNjmeUwXXap2XXa
     * [city] => 市名称。 深圳市
     * [gender] =>【注意】只有is_certified为T的时候才有意义，否则不保证准确性.  m
     * [is_certified] => 是否通过实名认证。T是通过 F是没有实名认证。 T
     * [is_student_certified] => F
     * [nick_name] => 李光春
     * [province] => 省份名称 广东省
     * [user_id] => 支付宝用户的userId 2088212587578201
     * [user_status] => 用户状态（Q/T/B/W）。    Q代表快速注册用户    T代表正常用户    B代表被冻结账户    W代表已注册，未激活的账户 T
     * [user_type] => 用户类型（1/2）    1代表公司账户2代表个人账户 2
     * )
     * @param string $appId
     * @param string $appSecret
     * @param array $auth_data
     * @return bool
     * @throws DtAppException
     */
    protected static function userInfo(string $appId, string $appSecret, array $auth_data)
    {
        if (empty($auth_data)) return false;
        $auth_token = $auth_data['access_token'];
        $timestamp = Tool::timeGetData();
        $params['app_id'] = $appId;
        $params['method'] = 'alipay.user.info.share';
        $params['format'] = self::$format;
        $params['charset'] = self::$post_charset;
        $params['sign_type'] = self::$sign_type;
        $params['timestamp'] = $timestamp;
        $params['version'] = self::$api_version;
        $params['auth_token'] = $auth_token;
        return self::aliPayHttp($params, $appSecret, 'alipay_user_info_share_response');
    }
}
