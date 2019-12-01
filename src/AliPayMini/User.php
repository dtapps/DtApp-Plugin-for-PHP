<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\AliPayMini;

/**
 * 用户
 * Class User
 * @package DtApp\AliPayMini
 */
class User extends Base
{
    /**
     * 小程序AppId
     * @var string|string
     */
    private $appId;

    /**
     * 小程序AppSecret
     * @var string|string
     */
    private $appSecret;

    /**
     * 仅支持JSON
     * @var string
     */
    private $format = 'json';

    /**
     * 请求使用的编码格式，如utf-8,gbk,gb2312等
     * @var string
     */
    private $post_charset = 'UTF-8';

    /**
     * 调用的接口版本
     * @var string
     */
    private $api_version = '1.0';

    /**
     *  商户生成签名字符串所使用的签名算法类型，目前支持RSA2和RSA，推荐使用RSA2
     * @var string
     */
    private $sign_type = 'RSA2';

    /**
     * 小程序信息
     * Auth constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
        parent::__construct($config);
    }

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
     * @param $auth_data
     * @return bool
     */
    protected function userInfo($auth_data)
    {
        if (empty($auth_data)) return false;
        $auth_token = $auth_data['access_token'];
        $timestamp = date("Y-m-d H:i:s");
        $params['app_id'] = $this->appId;
        $params['method'] = 'alipay.user.info.share';
        $params['format'] = $this->format;
        $params['charset'] = $this->post_charset;
        $params['sign_type'] = $this->sign_type;
        $params['timestamp'] = $timestamp;
        $params['version'] = $this->api_version;
        $params['auth_token'] = $auth_token;
        ksort($params); //对将要签名的数组排序
        $string = $this->toUrlParam($params);// 将数组转换成字符串
        $params['sign'] = $this->sign($string, $this->appSecret); //将字符串签名
        $params = http_build_query($params);
        $get_url = "$this->gateway_url?$params";
        $http_get = $this->tool->reqGetHttp($get_url, '', true);;
        if (isset($http_get['alipay_user_info_share_response'])) return $http_get['alipay_user_info_share_response'];
        return false;
    }
}
