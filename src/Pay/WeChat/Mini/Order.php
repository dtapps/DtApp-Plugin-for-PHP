<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Pay\WeChat\Mini;

use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

/**
 * 订单
 * Class Order
 * @package DtApp\Pay\WeChatMini
 */
class Order extends Base
{
    /**
     * 统一下单
     * @param array $params
     * @param string $appId 服务商的appId
     * @param string $mchId 商户号
     * @param string $subAppId 小程序的appId
     * @param string $subMchId 子商户号
     * @param string $notifyUrl
     * @param string $key
     * @param bool $milieu
     * @return string
     * @throws DtAppException
     */
    protected static function unified(array $params, string $appId, string $mchId, string $subAppId, string $subMchId, string $notifyUrl, string $key, bool $milieu)
    {
        $data = [
            'appid' => $appId, // 服务商的appId
            'mch_id' => $mchId, //商户号
            'sub_appid' => $subAppId, //小程序的appId
            'sub_mch_id' => $subMchId, //子商户号
            'nonce_str' => self::getNonceStr(), // 随机字符串
            'sign' => '', // 签名
            'sign_type' => 'MD5', // 签名类型
            'body' => $params['body'], // 商品描述
            'out_trade_no' => $params['out_trade_no'], // 商户订单号
            'fee_type' => $params['fee_type'], // 货币类型
            'total_fee' => $params['total_fee'], // 总金额
            'spbill_create_ip' => Tool::ipGet(), // 终端IP
            'time_start' => Tool::timeGetData('YmdHis'), // 交易起始时间
            'time_expire' => Tool::timeDateRear(), // 交易结束时间
            'notify_url' => $notifyUrl, // 通知地址
            'trade_type' => 'JSAPI', // 交易类型
            'limit_pay' => $params['limit_pay'] === false ? '' : 'no_credit', // 指定支付方式
            'openid' => $params['openid'], // 用户标识
            'receipt' => $params['receipt'] === false ? '' : 'Y', // 电子发票入口开放标识
        ];
        $data['sign'] = self::signMd5($data, $key); // 签名
        $url = self::getUrl('orderquery', $milieu);
        $xml = Tool::xmlArrayToXml($data);
        return Tool::reqPostXmlHttp($url, Tool::urlDeCode($xml));
    }

    /**
     * 查询订单支持（微信订单号、商户订单号）二选一
     * 微信订单号：['transaction_id'=>'1111']
     * 商户订单号：['out_trade_no'=>'1111']
     * @param string $appId 服务商的appId
     * @param string $mchId 商户号
     * @param string $subAppId 小程序的appId
     * @param string $subMchId 子商户号
     * @param array $out_no 订单数据
     * @param bool $milieu
     */
    protected static function query(string $appId, string $mchId, string $subAppId, string $subMchId, array $out_no, bool $milieu)
    {
        $params['appid'] = $appId; // 服务商的appId
        $params['mch_id'] = $mchId; //商户号
        $params['sub_appid'] = $subAppId; //小程序的appId
        $params['sub_mch_id'] = $subMchId; //子商户号
        $params['nonce_str'] = self::getNonceStr(); // 随机字符串
        $params['sign'] = self::signMd5([], ''); // 签名
        $params['sign_type'] = 'MD5'; // 签名类型
        array_push($params, $out_no); // 订单号数据
        $url = self::getUrl('orderquery', $milieu);
    }

    /**
     * 关闭订单
     * @param string $appId 服务商的appId
     * @param string $mchId 商户号
     * @param string $subAppId 小程序的appId
     * @param string $subMchId 子商户号
     * @param string $out_trade_no
     * @param bool $milieu
     */
    protected static function close(string $appId, string $mchId, string $subAppId, string $subMchId, string $out_trade_no, bool $milieu)
    {
        $params['appid'] = $appId; // 服务商的appId
        $params['mch_id'] = $mchId; //商户号
        $params['sub_appid'] = $subAppId; //小程序的appId
        $params['sub_mch_id'] = $subMchId; //子商户号
        $params['out_trade_no'] = $out_trade_no; // 商户订单号
        $url = self::getUrl('closeorder', $milieu);
    }

    protected static function refund()
    {

    }

    /**
     * 查询退款支持（微信订单号、商户订单号、商户退款单号、微信退款单号）四选一
     * 微信订单号：['transaction_id'=>'1111']
     * 商户订单号：['out_trade_no'=>'1111']
     * 商户退款单号：['out_refund_no'=>'1111']
     * 微信退款单号：['refund_id'=>'1111']
     * @param string $appId 服务商的appId
     * @param string $mchId 商户号
     * @param string $subAppId 小程序的appId
     * @param string $subMchId 子商户号
     * @param array $out_no 订单数据
     * @param bool $milieu 环境
     */
    protected static function refundQuery(string $appId, string $mchId, string $subAppId, string $subMchId, array $out_no, bool $milieu)
    {
        $params['appid'] = $appId; // 服务商的appId
        $params['mch_id'] = $mchId; //商户号
        $params['sub_appid'] = $subAppId; //小程序的appId
        $params['sub_mch_id'] = $subMchId; //子商户号
        array_push($params, $out_no); // 订单号数据
        $params['nonce_str'] = self::getNonceStr(); // 随机字符串
        $params['sign'] = self::signMd5([], ''); // 签名
        $params['sign_type'] = 'MD5'; // 签名类型
        $url = self::getUrl('refundquery', $milieu); // 网址
    }

    /**
     * 小程序调起支付API
     * https://pay.weixin.qq.com/wiki/doc/api/wxa/wxa_sl_api.php?chapter=7_7&index=5
     * @param string $appId
     * @param string $package
     * @param string $key
     * @return mixed
     */
    protected static function transferPayment(string $appId, string $package, string $key)
    {
        $params['appId'] = $appId; // 小程序ID
        $params['timeStamp'] = Tool::timeGetTime(); //时间戳
        $params['nonceStr'] = self::getNonceStr(); // 随机字符串
        $params['package'] = $package; //数据包
        $params['sign'] = self::signMd5([], $key); // 签名
        $params['sign_type'] = 'MD5'; // 签名类型
        return $params;
    }
}
