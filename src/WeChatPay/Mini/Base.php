<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChatPay\Mini;


class Base extends Client
{
    protected $wx_url = 'https://api.mch.weixin.qq.com/pay/';
    protected $wx_milieu_url = 'https://api.mch.weixin.qq.com/sandboxnew/pay/';

    /**
     * 查询网址
     * @param string $type
     * @param bool $milieu
     * @return string
     */
    public function getUrl(string $type, bool $milieu)
    {
        if (empty($milieu)) return $this->wx_url . $type;
        return $this->wx_milieu_url . $type;
    }

    /**
     * 返回随机数
     * @return string
     */
    public function getNonceStr()
    {
        return md5(uniqid(microtime(true), true));
    }
}
