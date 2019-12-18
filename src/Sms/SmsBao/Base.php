<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Sms\SmsBao;

use DtApp\Sms\SmsBaoClient;

/**
 * 短信宝-中间件
 * Class Base
 * @package DtApp\Sms\SmsBao
 */
class Base extends SmsBaoClient
{
    protected static $sms_bao_url = 'http://api.smsbao.com/';
    protected static $statusStr = [
        "0" => "0",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词",
        "51" => "手机号码不正确"
    ];
}
