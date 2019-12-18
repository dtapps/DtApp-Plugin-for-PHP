<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Sms\SmsBao;

/**
 * 短信宝-查询
 * Class Query
 * @package DtApp\Sms\SmsBao
 */
class Query extends Base
{
    /**
     * 获取当前账号余额接口
     * @param $user
     * @param $pass
     * @return bool|false|string
     */
    protected static function balance($user, $pass)
    {
        return file_get_contents(self::$sms_bao_url . "query?u=" . $user . "&p=" . md5($pass));
    }
}
