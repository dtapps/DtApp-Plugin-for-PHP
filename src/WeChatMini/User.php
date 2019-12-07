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
     * @param string $appId 小程序ID
     * @param string $appSecret 小程序密钥
     * @param string $jsCode 小程序登录code
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @return bool|mixed
     */
    protected function userInfo(string $appId, string $appSecret, string $jsCode, string $encryptedData, string $iv)
    {
        $session = $this->tool->reqGetHttp("$this->jscode2session_url?appid=$appId&secret=$appSecret&js_code=$jsCode&grant_type=authorization_code", '', true);
        if (!isset($session['openid'])) return false;
        $result = openssl_decrypt(base64_decode($encryptedData), "AES-128-CBC", base64_decode($session['session_key']), 1, base64_decode($iv));
        return json_decode($result, true);
    }
}
