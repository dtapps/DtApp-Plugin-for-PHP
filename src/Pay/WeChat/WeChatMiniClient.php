<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Pay\WeChat;

use DtApp\Pay\WeChat\Mini\Order;
use DtApp\Tool\DtAppException;

/**
 * 微信小程序支付
 * Class WeChatMiniClient
 * @package DtApp\Pay\WeChat
 */
class WeChatMiniClient
{
    /**
     * 服务商的appId
     * @var string
     */
    private static $appId = '';

    /**
     * 商户号
     * @var string
     */
    private static $mchId = '';

    /**
     * 小程序的appId
     * @var string
     */
    private static $subAppId = '';

    /**
     * 子商户号
     * @var string
     */
    private static $subMchId = '';

    /**
     * 是否为测试环境
     * @var bool
     */
    private static $milieu = false;

    /**
     * 货币类型（默认人民币）
     * @var string
     */
    private static $fee_type = 'CNY';

    /**
     * 交易类型
     * @var string
     */
    private static $trade_type = 'JSAPI';

    /**
     * 通知地址
     * @var mixed|string
     */
    private static $notify_url = '';

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig($config = [])
    {
        if (!empty($config['appId'])) self::$appId = $config['appId'];
        if (!empty($config['mchId'])) self::$mchId = $config['mchId'];
        if (!empty($config['subAppId'])) self::$subAppId = $config['subAppId'];
        if (!empty($config['subMchId'])) self::$subMchId = $config['subMchId'];
        if (!empty($config['milieu'])) self::$milieu = $config['milieu'];
        if (!empty($config['fee_type'])) self::$fee_type = $config['fee_type'];
        if (!empty($config['trade_type'])) self::$trade_type = $config['trade_type'];
        if (!empty($config['notify_url'])) self::$notify_url = $config['notify_url'];
    }

    /**
     * 统一下单
     * @param array $data
     * @return bool|void
     * @throws DtAppException
     */
    public static function orderUnified(array $data)
    {
        if (empty($data) || empty(self::$notify_url)) throw new DtAppException('请检查参数');
        return Order::unified($data, self::$appId, self::$mchId, self::$subAppId, self::$subMchId, self::$milieu);
    }

    /**
     * 查询订单支持（微信订单号、商户订单号）二选一
     * 微信订单号：['transaction_id'=>'1111']
     * 商户订单号：['out_trade_no'=>'1111']
     * @param array $out_no
     * @return bool|void
     */
    public static function orderQuery(array $out_no)
    {
        if (empty($out_no)) return false;
        return Order::query(self::$appId, self::$mchId, self::$subAppId, self::$subMchId, $out_no, self::$milieu);
    }

    /**
     * 查询退款支持（微信订单号、商户订单号、商户退款单号、微信退款单号）四选一
     * 微信订单号：['transaction_id'=>'1111']
     * 商户订单号：['out_trade_no'=>'1111']
     * 商户退款单号：['out_refund_no'=>'1111']
     * 微信退款单号：['refund_id'=>'1111']
     * @param array $out_no
     * @return bool|void
     */
    public static function orderRefundQuery(array $out_no)
    {
        if (empty($out_no)) return false;
        return Order::refundQuery(self::$appId, self::$mchId, self::$subAppId, self::$subMchId, $out_no, self::$milieu);
    }
}
