<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Pay\WeChat\Micro\v2;

use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

/**
 * 小微商户
 * Class AppLyMeNt
 * @package DtApp\Pay\WeChat\Micro
 */
class AppLyMeNt extends Base
{
    /**
     * 申请入驻
     * https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=19_2
     * @param string $mch_id
     * @param array $params
     * @param string $key
     * @return string
     * @throws DtAppException
     */
    protected static function submit(string $mch_id, array $params, string $key)
    {
        if (self::accountNumberIsSupport($params['account_number'] ?? "")) throw new DtAppException('银行卡不支持！');
        $cert_sn = self::getCertFiCaTes([
            'mch_id' => $mch_id
        ], $key);
        $data['version'] = '3.0'; // 接口版本号
        $data['cert_sn'] = $cert_sn;//平台证书序列号
        $data['mch_id'] = $mch_id;// 商户号
        $data['nonce_str'] = self::getNonceStr();//随机字符串
        $data['sign_type'] = 'HMAC-SHA256';//签名类型
        $data['business_code'] = self::getBusinessCode();//业务申请编号
        $data['id_card_copy'] = $params['id_card_copy'];//身份证人像面照片
        $data['id_card_national'] = $params['id_card_national'];//身份证国徽面照片
        $data['id_card_name'] = $params['id_card_name'];//身份证姓名
        $data['id_card_number'] = $params['id_card_number'];//身份证号码
        $data['id_card_valid_time'] = $params['id_card_valid_time'];//身份证有效期限
        $data['account_name'] = self::getEncrypt($params['account_name']);//开户名称
        $data['account_bank'] = $params['account_bank'];//开户银行
        $data['bank_address_code'] = $params['bank_address_code'];//开户银行省市编码
        $data['account_number'] = $params['account_number'];//银行账号
        $data['store_name'] = $params['store_name'];//门店名称
        $data['store_address_code'] = $params['store_address_code'];//门店省市编码
        $data['store_street'] = $params['store_street'];//门店街道名称
        $data['store_entrance_pic'] = $params['store_entrance_pic'];//门店门口照片
        $data['indoor_pic'] = $params['indoor_pic'];//店内环境照片
        $data['address_certification'] = $params['address_certification'];//经营场地证明
        $data['merchant_shortname'] = $params['merchant_shortname'];//商户简称
        $data['service_phone'] = $params['service_phone'];//客服电话
        $data['product_desc'] = self::judgeProductDesc($params['product_desc']); // 售卖商品/提供服务描述
        $data['rate'] = $params['rate'];// 费率
        $data['contact'] = self::getEncrypt($params['contact']); // 超级管理员姓名
        $data['contact_phone'] = self::getEncrypt($params['contact_phone']); // 手机号码
        $data['contact_email'] = self::getEncrypt($params['contact_email']); // 联系邮箱
        var_dump($data);
        $data['sign'] = self::sign($data, $key, $data['sign_type']);
        var_dump($data);
        exit();
        return Tool::reqPostXmlHttp(self::$_url . 'submit', Tool::xmlArrayToXml($data));
    }

    /**
     * 查询申请状态
     * https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=19_3
     * @param array $params
     * @param string $key
     * @return string
     * @throws DtAppException
     */
    protected static function getState(array $params, string $key)
    {
        $data['version'] = '1.0';// 接口版本号
        $data['mch_id'] = $params['mch_id'];//商户号
        $data['nonce_str'] = self::getNonceStr();//随机字符串
        $data['sign_type'] = 'HMAC-SHA256';//签名类型
        $data['applyment_id'] = isset($params['applyment_id']) ? $params['applyment_id'] : '';//商户申请单号
        $data['business_code'] = isset($params['business_code']) ? $params['business_code'] : '';//业务申请编号
        $data['sign'] = self::sign($data, $key, 'HMAC-SHA256');
        return Tool::reqPostXmlHttp(self::$_url . 'getstate', Tool::xmlArrayToXml($data));
    }

    /**
     * 提交升级申请单接口
     * https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=28_2&index=2
     * @param array $params
     * @param string $key
     * @throws DtAppException
     */
    protected static function submitUpgrade(array $params, string $key)
    {
        $cert_sn = self::getCertFiCaTes([
            'mch_id' => $params['mch_id']
        ], $key);
        $data['version'] = '1.0';// 接口版本号
        $data['mch_id'] = $params['mch_id'];//商户号
        $data['nonce_str'] = self::getNonceStr();//随机字符串
        $data['sign_type'] = 'HMAC-SHA256';//签名类型
        $data['cert_sn'] = $cert_sn;//平台证书序列号
        $data['sub_mch_id'] = $params['sub_mch_id'];//小微商户号
        $data['organization_type'] = $params['organization_type'];//主体类型
        $data['business_license_copy'] = $params['business_license_copy'];//营业执照扫描件
        $data['business_license_number'] = $params['business_license_number'];//营业执照注册号
        $data['merchant_name'] = $params['merchant_name'];//商户名称
        $data['company_address'] = $params['company_address'];//注册地址
        $data['legal_person'] = $params['legal_person'];//经营者姓名/法定代表人
        $data['business_time'] = $params['business_time'];//营业期限
        $data['business_licence_type'] = $params['business_licence_type'];//营业执照类型
        $data['organization_copy'] = $params['organization_copy'];//组织机构代码证照片
        $data['organization_number'] = $params['organization_number'];//组织机构代码
        $data['organization_time'] = $params['organization_time'];//组织机构代码有效期限
        $data['company_address'] = $params['company_address'];//注册地址
        $data['company_address'] = $params['company_address'];//注册地址
        $data['company_address'] = $params['company_address'];//注册地址
        $data['company_address'] = $params['company_address'];//注册地址
        $data['sign'] = self::sign($data, $key, 'HMAC-SHA256');
    }

    /**
     * 查询升级申请单状态接口
     * https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=28_3&index=3
     */
    protected static function getUpgradeState()
    {

    }
}
