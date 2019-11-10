<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/9
 * Time: 14:29
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\QqMini;


class User extends Base
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
     * 配置小程序信息
     * User constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['appid'])) $this->appid = $config['appid'];
        if (!empty($config['secret'])) $this->secret = $config['secret'];
    }

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
     * @param string $js_code 登录的code
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @return bool|false|mixed|string
     */
    public function getUserInfo(string $js_code, string $encryptedData, string $iv)
    {
        $auth = new Auth([
            'appid' => $this->appid,
            'secret' => $this->secret
        ]);
        $session = $auth->code2Session($js_code);
        if (strlen($session['session_key']) != 24) false;
        if (strlen($iv) != 24) return false;
        $result = openssl_decrypt(base64_decode($encryptedData), "AES-128-CBC", base64_decode($session['session_key']), 1, base64_decode($iv));
        $dataObj = json_decode($result);
        if ($dataObj == null) return false;
        if ($dataObj->watermark->appid != $this->appid) return false;
        $result = json_decode($result, true);
        unset($result['openId'], $result['watermark']);
        $result['openid'] = $session['openid'];
        $result['unionid'] = $session['unionid'];
        return $result;
    }
}
