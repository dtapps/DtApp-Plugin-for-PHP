<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice;


use DtApp\Notice\SendCloud\Base;

class SendCloudClient
{
    /**
     * apiUser
     * @var string
     */
    private static $api_user = '';

    /**
     * apiKey
     * @var string
     */
    private static $api_key = '';

    /**
     * 发件人地址
     * @var string
     */
    private static $from = '';

    /**
     * 发件人名称
     * @var string
     */
    private static $from_name = '';

    /**
     * 邮件模板调用名称
     * @var string
     */
    private static $template = '';

    public static function setConfig(array $config = [])
    {
        if (!empty($config['api_user'])) self::$api_user = $config['api_user'];
        if (!empty($config['api_key'])) self::$api_key = $config['api_key'];
        if (!empty($config['from'])) self::$from = $config['from'];
        if (!empty($config['from_name'])) self::$from_name = $config['from_name'];
        if (!empty($config['template'])) self::$template = $config['template'];
    }

    /**
     * 发送邮箱信息
     * @param string $email 收件人地址
     * @param string $title 邮箱标题
     * @param string $desc 邮箱描述
     * @param array $content 邮箱内容
     * @return bool
     */
    public static function sendEmail(string $email, string $title, string $desc, array $content)
    {
        return Base::send(self::$api_user, self::$api_key, self::$from, self::$from_name, self::$template, $email, $title, $desc, $content);
    }
}
