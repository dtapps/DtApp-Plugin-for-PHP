<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\QqMini;

use DtApp\Tool\Tool;

/**
 * QQ小程序
 * Class Base
 * @package DtApp\QqMini
 */
class Base extends Client
{
    protected $tool;

    /**
     * 登录凭证校验
     * @var string
     */
    protected $jscode2session_url = 'https://api.q.qq.com/sns/jscode2session';

    /**
     * 获取小程序全局唯一后台接口调用凭据
     * @var string
     */
    protected $getToken_url = 'https://api.q.qq.com/api/getToken';

    public function __construct()
    {
        $this->tool = new Tool();
    }
}
