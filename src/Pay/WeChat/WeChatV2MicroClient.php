<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Pay\WeChat;


use DtApp\Pay\WeChat\Micro\v2\AppLyMeNt;
use DtApp\Pay\WeChat\Micro\v2\SecApi;
use DtApp\Tool\DtAppException;

class WeChatV2MicroClient
{
    /**
     * 商户号
     * @var string
     */
    private static $mchId = '';

    /**
     * API密钥
     * @var string
     */
    private static $apiKey = '';

    /**
     * APIv3密钥
     * @var string
     */
    private static $apiV3Key = '';

    /**
     * 商户API证书序列号
     * @var string
     */
    private static $serialNo = '';

    /**
     * 公钥
     * @var string
     */
    private static $publicKey = '';

    /**
     * 私钥
     * @var string
     */
    private static $privateKey = '';

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig($config = [])
    {
        if (!empty($config['mchId'])) self::$mchId = $config['mchId'];
        if (!empty($config['apiKey'])) self::$apiKey = $config['apiKey'];
        if (!empty($config['apiV3Key'])) self::$apiV3Key = $config['apiV3Key'];
        if (!empty($config['serialNo'])) self::$serialNo = $config['serialNo'];
        if (!empty($config['publicKey'])) self::$publicKey = $config['publicKey'];
        if (!empty($config['privateKey'])) self::$privateKey = $config['privateKey'];
    }

    /**
     * @param array $data
     * @return string
     * @throws DtAppException
     */
    public static function meNtCreate(array $data)
    {
        return AppLyMeNt::submit(self::$mchId, $data, self::$apiKey);
    }

    /**
     * 图片上传
     * @param string $file
     * @return string
     */
    public static function updateImg(string $file)
    {
        return SecApi::uploadMedia(self::$mchId, realpath($file), self::$serialNo, realpath(self::$privateKey));
    }
}
