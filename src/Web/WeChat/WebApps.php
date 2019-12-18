<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Web\WeChat;

use DtApp\Tool\Tool;

/**
 * 微信网页
 * https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/iOS_WKWebview.html
 * Class WebApps
 * @package DtApp\Web\WeChat
 */
class WebApps extends Base
{
    /**
     * 网页授权
     * @param string $appId
     * @param string $url 授权后重定向的回调链接地址
     * @param string $scope 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     */
    protected static function oauth2(string $appId, string $url, string $scope)
    {
        $redirect_uri = Tool::urlLenCode($url);
        $data = [
            'appid' => $appId,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => $scope,
            'state' => 1
        ];
        $params = Tool::urlToParams($data);
        return header("Location:" . self::$authorize_url . "?$params#wechat_redirect");
    }
}
