<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\QqMini;

/**
 * 用户
 * Class User
 * @package DtApp\QqMini
 */
class User extends Base
{
    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * 成功后返回用户资料和openid、unionid
     * Array
     * (
     * [avatarUrl] => https://thirdqq.qlogo.cn/qqapp/1109685000/737A2CE3272BA0CBB787697107B4C5EB/100
     * [city] => 深圳
     * [country] => 中国
     * [gender] => 1
     * [language] => zh_CN
     * [nickName] => Chaim
     * [province] => 广东
     * [unionId] => UID_09701111AAA13D95E1BB854C698B8749
     * [openid] => 737A2CE3272BA0CBB787697107B4C5EB
     * [unionid] => UID_09701111AAA13D95E1BB854C698B8749
     * )
     * @param $session
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @return bool|false|mixed|string
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
