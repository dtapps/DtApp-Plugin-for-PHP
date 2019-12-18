<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\MiniProgram\QQ;

use DtApp\Tool\DtAppException;

/**
 * 用户
 * Class User
 * @package DtApp\MiniProgram\QQ
 */
class User extends Base
{
    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * 成功后返回用户资料
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
     * )
     * @param string $session
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @return bool|false|mixed|string
     * @throws DtAppException
     */
    protected static function userInfo(string $session, string $encryptedData, string $iv)
    {
        if (empty($session) || empty($encryptedData) || empty($iv)) throw new DtAppException('请检查参数');
        $result = openssl_decrypt(base64_decode($encryptedData), "AES-128-CBC", base64_decode($session['session_key']), 1, base64_decode($iv));
        return json_decode($result, true);
    }
}
