<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Web\WeChat;

use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

/**
 * https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Generating_a_Parametric_QR_Code.html
 * Class AccOun
 * @package DtApp\Web\WeChat
 */
class AccOun extends Base
{
    /**
     * 将一条长链接转成短链接
     * @param string $url 网址
     * @param string $accessToken token
     * @return bool
     * @throws DtAppException
     */
    protected static function shortUrl(string $url, string $accessToken)
    {
        $data = [
            'access_token' => $accessToken
        ];
        $params = Tool::urlToParams($data);
        return Tool::reqPostHttp(self::$shorturl_url . "?$params", [
            'action' => 'long2short',
            'long_url' => $url
        ], true);
    }
}
