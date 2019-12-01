<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChat;

use DtApp\Tool\Tool;

/**
 * 中间
 * Class Base
 * @package DtApp\WeChat
 */
class Base extends Client
{
    protected $tool;

    /**
     * 微信授权登录（OAuth2.0）
     * @var string
     */
    protected $authorize_url = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    /**
     * 将一条长链接转成短链接
     * @var string
     */
    protected $shorturl_url = 'https://api.weixin.qq.com/cgi-bin/shorturl';

    public function __construct()
    {
        $this->tool = new Tool();
    }
}
