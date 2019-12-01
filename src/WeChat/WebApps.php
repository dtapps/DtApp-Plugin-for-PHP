<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChat;

/**
 * 微信网页
 * https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/iOS_WKWebview.html
 * Class Auth
 * @package DtApp\WeChat
 */
class WebApps extends Base
{
    /**
     * 公众号ID
     * @var mixed|string
     */
    private $appId = '';

    /**
     * 公众号配置
     * WebApps constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        parent::__construct($config);
    }

    /**
     * 网页授权
     * @param string $url 授权后重定向的回调链接地址
     * @param string $scope 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     */
    protected function oauth2(string $url, string $scope)
    {
        $redirect_uri = $this->tool->urlLenCode($url);
        return header("Location:$this->authorize_url?appid=$this->appId&redirect_uri=$redirect_uri&response_type=code&scope=$scope&state=1#wechat_redirect");
    }
}
