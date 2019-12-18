<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Pay\WeChat\Mini;


use DtApp\Pay\WeChat\WeChatMiniClient;
use DtApp\Tool\Tool;

/**
 * 中间件
 * Class Base
 * @package DtApp\Pay\WeChatMini
 */
class Base extends WeChatMiniClient
{
    /**
     * 线上域名
     * @var string
     */
    protected static $wx_url = 'https://api.mch.weixin.qq.com/pay/';

    /**
     * 测试域名
     * @var string
     */
    protected static $wx_milieu_url = 'https://api.mch.weixin.qq.com/sandboxnew/pay/';

    /**
     * 查询网址
     * @param string $type
     * @param bool $milieu
     * @return string
     */
    protected static function getUrl(string $type, bool $milieu)
    {
        if (empty($milieu)) return self::$wx_url . $type;
        return self::$wx_milieu_url . $type;
    }

    /**
     * 返回随机数
     * @return string
     */
    protected static function getNonceStr()
    {
        return md5(uniqid(microtime(true), true));
    }

    /**
     * MD5签名方式
     * @param array $arr 数据
     * @param string $signKey 商户平台设置的密钥key
     * @return string
     */
    protected static function signMd5(array $arr, string $signKey)
    {
        $params = array_filter($arr); //去除数组中的空值
        ksort($params); //对将要签名的数组排序
        $stringA = Tool::urlToParams($params); // 将数组转换成字符串
        $stringSignTemp = $stringA . "&key=$signKey";
        $params['sign'] = strtoupper(md5($stringSignTemp)); //MD5，字符转换为大写
        return http_build_query($params);
    }

    /**
     * HMAC-SHA256签名方式
     * @param array $arr 数据
     * @param string $signKey 商户平台设置的密钥key
     * @return string
     */
    protected static function signHashHmac(array $arr, string $signKey)
    {
        $params = array_filter($arr); //去除数组中的空值
        ksort($params); //对将要签名的数组排序
        $stringA = Tool::urlToParams($params); // 将数组转换成字符串
        $stringSignTemp = $stringA . "&key=$signKey";
        $params['sign'] = hash_hmac('sha256', $stringSignTemp, $signKey);; //HMAC-SHA256签名方式
        return http_build_query($params);
    }
}
