<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Pay\WeChat\Micro\v2;


use DtApp\Pay\WeChat\WeChatV2MicroClient;
use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

class Base extends WeChatV2MicroClient
{
    protected static $_url = 'https://api.mch.weixin.qq.com/applyment/micro/';

    /**
     * 返回随机数
     * @return string
     */
    protected static function getNonceStr()
    {
        return md5(uniqid(microtime(true), true));
    }

    /**
     * 敏感信息加密
     * @param string|int $str 待加密字符串
     * @return string
     * @throws DtAppException
     */
    protected static function getEncrypt($str)
    {
        if (empty($str)) throw new DtAppException('请检查数据');
        $public_key_path = __DIR__ . '././apiclient_cert.pem';
        $public_key = file_get_contents($public_key_path);
        $encrypted = '';
        openssl_public_encrypt($str, $encrypted, $public_key, OPENSSL_NO_PADDING);
        //base64编码
        return base64_encode($encrypted);
    }

    /**
     * 判断售卖商品/提供服务描述
     * @param string $str 参数
     * @return mixed
     * @throws DtAppException
     */
    protected static function judgeProductDesc(string $str)
    {
        if (in_array($str, ['餐饮', '线下零售', '居民生活服务', '休闲娱乐', '交通出行', '其他'])) return $str;
        throw new DtAppException('售卖商品/提供服务描述：参数错误；参数范围：【餐饮、线下零售、居民生活服务、休闲娱乐、交通出行、其他】');
    }

    /**
     * 判断银行卡账号是否支持
     * @param string $account_number
     * @return bool
     */
    protected static function accountNumberIsSupport(string $account_number)
    {
        $account_prefix_6 = substr($account_number, 0, 6);
        $account_prefix_8 = substr($account_number, 0, 8);
        $not_support = ["623501", "621468", "620522", "625191", "622384", "623078", "940034", "622150", "622151", "622181", "622188", "955100", "621095", "620062", "621285", "621798", "621799", "621797", "622199", "621096", "62215049", "62215050", "62215051", "62218849", "62218850", "62218851", "621622", "623219", "621674", "623218", "621599", "623698", "623699", "623686", "621098", "620529", "622180", "622182", "622187", "622189", "621582", "623676", "623677", "622812", "622810", "622811", "628310", "625919", "625368", "625367", "518905", "622835", "625603", "625605", "518905"];
        if (array_search($account_prefix_6, $not_support)) return true;
        if (array_search($account_prefix_8, $not_support)) return true;
        return false;
    }

    /**
     * 生成业务申请编号
     * @return string
     */
    protected static function getBusinessCode()
    {
        return mb_strtoupper(md5(uniqid(self::getMillisecond() . mt_rand())));
    }

    private static function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    /**
     * 生成签名
     * @param array $data
     * @param $key
     * @param string $signType
     * @return string
     */
    protected static function sign(array $data, $key, $signType = 'HMAC-SHA256')
    {
        //签名步骤一：按字典序排序参数
        ksort($data);
        $string = Tool::urlToParams($data);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $key;
        //签名步骤三：MD5加密或者HMAC-SHA256
        if ($signType == 'md5') {
            //如果签名小于等于32个,则使用md5验证
            $string = md5($string);
        } else {
            //是用sha256校验
            $string = hash_hmac("sha256", $string, $key);
        }
        //签名步骤四：所有字符转为大写
        return strtoupper($string);
    }

    private static $risk_url = 'https://api.mch.weixin.qq.com/risk/getcertficates';

    /**
     * 调用获取平台证书V2接口之前，请前往微信支付商户平台升级API证书，升级后才可成功调用本接口。
     * https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=19_11
     * @param array $params 数据
     * @param string $key 商户的APIv3密钥
     * @return string
     * @throws DtAppException
     */
    protected static function getCertFiCaTes(array $params, string $key)
    {
        $data = [
            'mch_id' => $params['mch_id'],// 商户号
            'nonce_str' => self::getNonceStr(),//随机字符串
            'sign_type' => 'HMAC-SHA256'//签名类型
        ];
        $data['sign'] = self::sign($data, $key, 'HMAC-SHA256');
        $res = Tool::reqPostXmlHttp(self::$risk_url, Tool::xmlArrayToXml($data));
        $json = json_decode($res['certificates'], true);
        if (!isset($json['data'][0]['serial_no'])) throw new DtAppException('获取平台证书接口异常');
        return $json['data'][0]['serial_no'];
    }

    /**
     * 加密后的证书内容解密
     * @param string $ciphertext 加密后的证书内容
     * @param string $nonce 加密证书的随机串,加密证书的随机串
     * @param string $key 你的APIv3密钥
     * @return false|string
     */
    protected static function decodePem(string $ciphertext, string $nonce, string $key)
    {
        $associated_data = 'certificate';
        $check_sodium_mod = extension_loaded('sodium');
        if ($check_sodium_mod === false) {
            echo '没有安装sodium模块';
            die;
        }
        $check_aes256gcm = sodium_crypto_aead_aes256gcm_is_available();
        if ($check_aes256gcm === false) {
            echo '当前不支持aes256gcm';
            die;
        }
        return sodium_crypto_aead_aes256gcm_decrypt(base64_decode($ciphertext), $associated_data, $nonce, $key);//这是解密出来的证书内容,复制出来保存就行了
    }
}
