<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/8
 * Time: 0:52
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\AliPayMini;


class User extends Base
{
    /**
     * 小程序AppId
     * @var string|string
     */
    private $appid;

    /**
     * 小程序AppSecret
     * @var string|string
     */
    private $secret;

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
        if (!empty($config['appid'])) $this->appid = $config['appid'];
        if (!empty($config['secret'])) $this->secret = $config['secret'];
    }

    /**
     * 支付宝会员授权信息查询接口
     * https://docs.open.alipay.com/api_2/alipay.user.info.share
     * @param $auth_token
     * @return bool
     */
    public function getUserInfo($auth_token)
    {
        $timestamp = date("Y-m-d H:i:s");
        $params['app_id'] = $this->appid;
        $params['method'] = 'alipay.user.info.share';
        $params['format'] = $this->format;
        $params['charset'] = $this->post_charset;
        $params['sign_type'] = $this->sign_type;
        $params['timestamp'] = $timestamp;
        $params['version'] = $this->api_version;
        $params['auth_token'] = $auth_token;
        ksort($params); //对将要签名的数组排序
        $string = $this->toUrlParam($params);// 将数组转换成字符串
        $params['sign'] = $this->sign($string, $this->secret); //将字符串签名
        $get_url = "https://openapi.alipay.com/gateway.do?$params";
        $params = http_build_query($params);
        $http_get = $this->get_http($get_url);
        if (isset($http_get['alipay_user_info_share_response'])) return $http_get['alipay_user_info_share_response'];
        return false;
    }
}
