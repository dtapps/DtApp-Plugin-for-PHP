<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChat;

/**
 * https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Generating_a_Parametric_QR_Code.html
 * Class Accoun
 * @package DtApp\WeChat
 */
class Accoun extends Base
{
    /**
     * 将一条长链接转成短链接
     * @param string $url 网址
     * @param string $accessToken token
     * @return bool
     */
    protected function shorturl(string $url, string $accessToken)
    {
        $shorturl = "$this->shorturl_url?access_token=$accessToken";
        $data = $this->tool->reqPostHttp($shorturl, '{"action":"long2short","long_url":"' . $url . '"}', true);
        if (!empty($data['errcode'])) return false;
        return $data['short_url'];
    }
}
