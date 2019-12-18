<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\MiniProgram\QQ;

use DtApp\MiniProgram\QQClient;

/**
 * QQ小程序
 * Class Base
 * @package DtApp\MiniProgram\QQ
 */
class Base extends QQClient
{
    /**
     * 登录凭证校验
     * @var string
     */
    protected static $jscode2session_url = 'https://api.q.qq.com/sns/jscode2session';

    /**
     * 获取小程序全局唯一后台接口调用凭据
     * @var string
     */
    protected static $getToken_url = 'https://api.q.qq.com/api/getToken';
}
