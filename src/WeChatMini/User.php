<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 16:23
 * User: 李光春 gc@dtapp.net
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
     * 错误状态码
     * @var string
     */
    private $code = '';
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
     * User constructor.
     * @param string $appid
     * @param string $secret
     */
    public function __construct(string $appid, string $secret)
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * @param string $js_code
     * @param string $encryptedData 加密的用户数据
     * @param string $iv 与用户数据一同返回的初始向量
     * @param $data 解密后的原文
     * @return int 成功0，失败返回对应的错误码
     */
    public function getUserInfo(string $js_code, string $encryptedData, string $iv, &$data)
    {
        $auth = new Auth($this->appid, $this->secret);
        $sessionKey = $auth->code2Session($js_code);
        if (strlen($sessionKey) != 24) $this->code = -41001;
        if (strlen($iv) != 24) $this->code = -41002;
        $result = openssl_decrypt(base64_decode($encryptedData), "AES-128-CBC", base64_decode($sessionKey), 1, base64_decode($iv));
        $dataObj = json_decode($result);
        if ($dataObj == null) $this->code = -41003;
        if ($dataObj->watermark->appid != $this->appid) $this->code = -41003;
        $data = $result;
        return 0;
    }

    /**
     * 获取错误信息
     * @return array
     */
    public function getError()
    {
        return ['code' => $this->code, 'msg' => $this->error($this->code)];
    }

    /**
     * 错误码描述
     * @param $code
     * @return mixed
     */
    private function error($code)
    {
        try {
            $data[0] = 'ok';
            return $data[$code];
        } catch (\Exception $e) {
            return '未定义';
        }
    }
}
