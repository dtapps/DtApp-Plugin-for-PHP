<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\WeChatPay\Mini;

/**
 * 订单
 * Class Order
 * @package DtApp\WeChatPay\Mini
 */
class Order extends Base
{
    /**
     * 统一下单
     * @param string $device_info
     * @param string $sign
     * @param string $sign_type
     * @param string $body
     * @param string $detail
     * @param string $attach
     * @param string $out_trade_no
     * @param string $fee_type
     * @param int $total_fee
     * @param string $spbill_create_ip
     * @param string $time_start
     * @param string $time_expire
     * @param string $goods_tag
     * @param string $notify_url
     * @param string $trade_type
     * @param string $limit_pay
     * @param string $openid
     * @param string $sub_openid
     * @param string $receipt
     * @param string $scene_info
     */
    public function unified(string $device_info, string $sign, string $sign_type, string $body, string $detail, string $attach, string $out_trade_no, string $fee_type, int $total_fee, string $spbill_create_ip, string $time_start, string $time_expire, string $goods_tag, string $notify_url, string $trade_type, string $limit_pay, string $openid, string $sub_openid, string $receipt, string $scene_info)
    {

    }

    /**
     * 通过商户订单号查询订单
     * @param string $out_trade_no
     * @param string $nonce_str
     * @param string $sign
     * @param string $sign_type
     */
    public function queryMerchant(string $out_trade_no, string $nonce_str, string $sign, string $sign_type)
    {

    }

    /**
     * 通过微信订单号查询订单
     * @param string $transaction_id
     * @param string $nonce_str
     * @param string $sign
     * @param string $sign_type
     */
    public function queryWeChat(string $transaction_id, string $nonce_str, string $sign, string $sign_type)
    {

    }

    /**
     * 关闭订单
     * @param string $out_trade_no
     * @param string $sign
     * @param string $sign_type
     * @param bool $milieu
     */
    public function close(string $out_trade_no, string $sign, string $sign_type, bool $milieu)
    {
        $url = $this->getUrl('closeorder', $milieu);
        $nonce_str = $this->getNonceStr();
    }
}
