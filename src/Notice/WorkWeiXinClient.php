<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice;


use DtApp\Notice\WorkWeiXin\Base;
use DtApp\Tool\DtAppException;

class WorkWeiXinClient
{
    /**
     * 接口链接
     * @var string
     */
    private static $webhook = '';

    /**
     * 配置
     * Client constructor.
     * @param array $config
     */
    public static function setConfig(array $config = [])
    {
        if (!empty($config['webhook'])) self::$webhook = $config['webhook'];
    }

    /**
     * 发送企业微信信息
     * @param string $content
     * @return bool
     * @throws DtAppException
     */
    public static function sendText(string $content = '')
    {
        return Base::text(self::$webhook, $content);
    }

    /**
     * 发送企业微信markdown信息
     * @param string $content
     * @return bool
     * @throws DtAppException
     */
    public static function sendMarkdown(string $content = '')
    {
        return Base::markdown(self::$webhook, $content);
    }
}
