<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 16:43
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\WeChatMini;

/**
 * 授权相关
 * Class Auth
 * @package DtApp\WeChatMini
 */
class Auth extends Base
{
    /**
     * 小程序AppId
     * @var string|string
     */
    private $appid = '';

    /**
     * 小程序AppSecret
     * @var string|string
     */
    private $secret = '';

    /**
     * token保存的地址
     * @var string
     */
    private $tokenFile = '';

    /**
     * 配置小程序信息
     * Auth constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appid'])) $this->appid = $config['appid'];
        if (!empty($config['secret'])) $this->secret = $config['secret'];
        if (!empty($config['tokenfile'])) $this->tokenFile = $config['tokenfile'];
    }

    /**
     * 登录凭证校验。通过 wx.login 接口获得临时登录凭证 code 后传到开发者服务器调用此接口完成登录流程
     * https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/login/auth.code2Session.html
     * -1 系统繁忙，此时请开发者稍候再试
     * 0 请求成功
     * 40029 code无效
     * 45011 频率限制，每个用户每分钟100次
     * @param string $js_code 登录时获取的 code
     * @return bool|mixed
     */
    public function code2Session(string $js_code = '')
    {
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$this->appid&secret=$this->secret&js_code=$js_code&grant_type=authorization_code";
        $get = $this->get_http($url);
        if (!isset($get['openid'])) return false;
        if (isset($get['unionid'])) return $get;
        foreach ($get as $k => $v) {
            $get['unionid'] = '';
        }
        return $get;
    }

    /**
     * 用户支付完成后，获取该用户的 UnionId，无需用户授权
     * https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/user-info/auth.getPaidUnionId.html
     * -1 系统繁忙，此时请开发者稍候再试
     * 0 请求成功
     * 40029 code无效
     * 45011 频率限制，每个用户每分钟100次
     * -2100    参数错误，请检查appid和appsecret是否正确
     * @param string $openid 支付用户唯一标识
     * @param string $transaction_id 微信支付订单号
     * @return bool|mixed
     */
    public function getPaidUnionIdTI(string $openid = '', string $transaction_id = '')
    {
        $url = "https://api.weixin.qq.com/wxa/getpaidunionid?access_token=ACCESS_TOKEN&openid=$openid&transaction_id=$transaction_id";
        $get = $this->get_http($url);
        if ($get['errcode'] == 0) return false;
        return $get;
    }

    /**
     * 用户支付完成后，获取该用户的 UnionId，无需用户授权
     * https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/user-info/auth.getPaidUnionId.html
     * -1 系统繁忙，此时请开发者稍候再试
     * 0 请求成功
     * 40029 code无效
     * 45011 频率限制，每个用户每分钟100次
     * -2100    参数错误，请检查appid和appsecret是否正确
     * @param string $openid 支付用户唯一标识
     * @param string $mch_id 微信支付商户订单号
     * @param string $out_trade_no 微信支付商户号
     * @return bool|mixed
     */
    public function getPaidUnionIdOM(string $openid = '', string $mch_id = '', string $out_trade_no = '')
    {
        $url = "https://api.weixin.qq.com/wxa/getpaidunionid?access_token=ACCESS_TOKEN&openid=$openid&mch_id=$mch_id&out_trade_no=$out_trade_no";
        $get = $this->get_http($url);
        if ($get['errcode'] == 0) return false;
        return $get;
    }

    /**
     * 获取小程序全局唯一后台接口调用凭据（access_token）。调用绝大多数后台接口时都需使用 access_token，开发者需要进行妥善保存。
     * https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/access-token/auth.getAccessToken.html
     * -1 系统繁忙，此时请开发者稍候再试
     * 0 请求成功
     * 40001 AppSecret 错误或者 AppSecret 不属于这个小程序，请开发者确认 AppSecret 的正确性
     * 40002 请确保 grant_type 字段值为 client_credential
     * 40013 不合法的 AppID，请开发者检查 AppID 的正确性，避免异常字符，注意大小写
     * @return bool
     */
    public function getAccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";
        $file = $this->tokenFile . $this->appid . '_access_token.json';//文件名
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true);
            if ($data['expire_time'] < time() or !$data['expire_time']) {
                $get = $this->get_http($url);
                if (isset($get['errcode'])) return false;
                $access_token = $get['access_token'];
                if ($access_token) @file_put_contents($file, json_encode(['expire_time' => time() + 6000, 'access_token' => $get['access_token']]));
            } else {
                $access_token = $data['access_token'];
            }
        } else {
            $get = $this->get_http($url);
            if (isset($get['errcode'])) return false;
            $access_token = $get['access_token'];
            if ($access_token) @file_put_contents($file, json_encode(['expire_time' => time() + 6000, 'access_token' => $get['access_token']]));
        }
        return $access_token;
    }
}
