<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Web\WeChat;

use DtApp\Web\WeChatClient;

/**
 * 中间件
 * Class Base
 * @package DtApp\Web\WeChat
 */
class Base extends WeChatClient
{
    /**
     * 微信授权登录（OAuth2.0）
     * @var string
     */
    protected static $authorize_url = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    /**
     * 将一条长链接转成短链接
     * @var string
     */
    protected static $shorturl_url = 'https://api.weixin.qq.com/cgi-bin/shorturl';
}
