<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Sms\SmsBao;

/**
 * 短信宝-发送
 * Class Send
 * @package DtApp\Sms\SmsBao
 */
class Send extends Base
{
    /**
     * 发送国内短信
     * @param string $user 平台账号
     * @param string $pass 平台密码
     * @param int $iphone 手机号码
     * @param string | int $code 码
     * @param string $template 模板
     * @param string $rep 替换
     * @return mixed
     */
    protected static function sms(string $user, string $pass, int $iphone, $code, string $template, string $rep)
    {
        $content = str_replace($rep, $code, $template);
        $url = self::$sms_bao_url . "sms?u=" . $user . "&p=" . md5($pass) . "&m=" . $iphone . "&c=" . urlencode($content);
        $result = file_get_contents($url);
        return self::$statusStr[$result];
    }
}
