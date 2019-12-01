<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChatMini;

use DtApp\Tool\Tool;

/**
 * 微信小程序
 * Class Config
 * @package liguangchun\WeMini
 */
class Base
{
    protected $tool;

    /**
     * 登录凭证校验
     * @var string
     */
    protected $jscode2session_url = 'https://api.weixin.qq.com/sns/jscode2session';

    /**
     * 用户支付完成后，获取该用户的 UnionId，无需用户授权
     * @var string
     */
    protected $getpaidunionid_url = 'https://api.weixin.qq.com/wxa/getpaidunionid';

    /**
     * 获取小程序全局唯一后台接口调用凭据
     * @var string
     */
    protected $token_url = 'https://api.weixin.qq.com/cgi-bin/token';

    public function __construct()
    {
        $this->tool = new Tool();
    }
}
