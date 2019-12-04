<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChatMini;

/**
 * 用户相关
 * Class User
 * @package DtApp\WeChatMini
 */
class User extends Base
{
    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * 成功后返回用户资料和openid、unionid
     * @param $appId 小程序ID
     * @param $appSecret 小程序密钥
     * @param $jsCode 小程序登录code
     * @param $encryptedData 加密的用户数据
     * @param $iv 与用户数据一同返回的初始向量
     * @return bool|false|mixed|string
     */
    protected function userInfo($appId, $appSecret, $jsCode, $encryptedData, $iv)
    {
        $url = "$this->jscode2session_url?appid=$appId&secret=$appSecret&js_code=$jsCode&grant_type=authorization_code";
        $session = $this->tool->reqGetHttp($url, '', true);
        if (!isset($session['openid'])) return false;
        if (!isset($session['unionid'])) $session['unionid'] = '';
        $result = openssl_decrypt(base64_decode($encryptedData), "AES-128-CBC", base64_decode($session['session_key']), 1, base64_decode($iv));
        $result = json_decode($result, true);
        unset($result['watermark']);
        isset($result['openId']) ? $result['openId'] : $session['openid'];
        if (!empty($result['openId'])) $result['unionid'] = $session['unionid'];
        return $result;
    }
}
