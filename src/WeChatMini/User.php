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
     * @param string $session
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @return false|mixed|string
     */
    protected function userInfo($session, $encryptedData, $iv)
    {
        $result = openssl_decrypt(base64_decode($encryptedData), "AES-128-CBC", base64_decode($session['session_key']), 1, base64_decode($iv));
        $result = json_decode($result, true);
        unset($result['watermark']);
        isset($result['openId']) ? $result['openId'] : $session['openid'];
        $result['unionid'] = $session['unionid'];
        return $result;
    }
}
