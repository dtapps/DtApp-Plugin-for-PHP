<?php
/**
 * Name:LiGuAngChun
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\WeChatPay\Mini;


class Base extends Client
{
    protected $wx_url = 'https://api.mch.weixin.qq.com/pay/';
    protected $wx_milieu_url = 'https://api.mch.weixin.qq.com/sandboxnew/pay/';
    protected $orderquery_url = 'https://api.mch.weixin.qq.com/pay/orderquery';
    protected $closeorder_url = 'https://api.mch.weixin.qq.com/pay/closeorder';

    public function getUrl($type, $milieu)
    {
        if (empty($milieu)) return $this->wx_url . $type;
        return $this->wx_milieu_url . $type;
    }

    public function getNonceStr()
    {
        return md5(uniqid(microtime(true), true));
    }
}
