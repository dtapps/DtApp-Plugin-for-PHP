<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\QqMini;

/**
 * 授权
 * Class Auth
 * @package DtApp\QqMini
 */
class Auth extends Base
{
    /**
     * 小程序AppId
     * @var string|string
     */
    private $appId;

    /**
     * 小程序AppSecret
     * @var string|string
     */
    private $appSecret;

    /**
     * token保存的地址
     * @var string
     */
    private $tokenFile;

    /**
     * 配置小程序信息
     * Auth constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['appSecret'])) $this->appSecret = $config['appSecret'];
        if (!empty($config['tokenFile'])) $this->tokenFile = $config['tokenFile'];
        parent::__construct($config);
    }

    /**
     * 登录凭证校验。通过 qq.login() 接口获得临时登录凭证 code 后传到开发者服务器调用此接口完成登录流程。更多使用方法详见 小程序登录。
     * https://q.qq.com/wiki/develop/miniprogram/server/open_port/port_login.html#code2session
     * Array
     * (
     * [errcode] => 错误码 0
     * [errmsg] => 错误信息
     * [openid] => 用户唯一标识 737A2CE3272BA0CBB787697107B4C5EB
     * [session_key] => 会话密钥 NEV3MXdnNjdrYmdGNkI5Vg==
     * [uin] =>
     * [unionid] =>用户在开放平台的唯一标识符，在满足 UnionID 下发条件的情况下会返回 UID_09701111AAA13D95E1BB854C698B8749
     * )
     * -1    系统繁忙，此时请开发者稍候再试
     * 0    请求成功
     * 40029    code 无效
     * 45011    频率限制，每个用户每分钟100次
     * -101222100    参数错误，请检查appid和appsecret是否正确,请检查ide上创建工程用的appid是否正确
     * @param string $js_code 登录时获取的 code
     * @return bool|mixed
     */
    protected function code2Session($js_code)
    {
        $url = "$this->jscode2session_url?appid=$this->appId&secret=$this->appSecret&js_code=$js_code&grant_type=authorization_code";
        $get = $this->tool->reqGetHttp($url, '', true);
        if (!empty($get['errcode'])) return false;
        if (isset($get['unionid'])) return $get;
        foreach ($get as $k => $v) $get['unionid'] = '';
        return $get;
    }

    /**
     * 接口调用凭证
     * https://q.qq.com/wiki/develop/miniprogram/server/open_port/port_use.html#getaccesstoken
     * -1    系统繁忙，此时请开发者稍候再试
     * 0    请求成功
     * 40001    AppSecret 错误或者 AppSecret 不属于这个小程序，请开发者确认 AppSecret 的正确性
     * 40002    请确保 grant_type 字段值为 client_credential
     * 40013    不合法的 AppID，请开发者检查 AppID 的正确性，避免异常字符，注意大小写
     * @return bool
     */
    protected function accessToken()
    {
        $url = "$this->getToken_url?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
        $file = $this->tokenFile . $this->appId . '_access_token.json';//文件名
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true);
            if ($data['expire_time'] < time() or !$data['expire_time']) {
                $get = $this->tool->reqGetHttp($url, '', true);
                if (isset($get['errcode'])) return false;
                $access_token = $get['access_token'];
                if ($access_token) @file_put_contents($file, json_encode(['expire_time' => time() + 6000, 'access_token' => $get['access_token']]));
            } else {
                $access_token = $data['access_token'];
            }
        } else {
            $get = $this->tool->reqGetHttp($url, '', true);
            if (isset($get['errcode'])) return false;
            $access_token = $get['access_token'];
            if ($access_token) @file_put_contents($file, json_encode(['expire_time' => time() + 6000, 'access_token' => $get['access_token']]));
        }
        return $access_token;
    }
}
