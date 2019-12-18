<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice;


use DtApp\Notice\DingTalk\Base;
use DtApp\Tool\DtAppException;

class DingDingClient
{
    /**
     * 钉钉自定义机器人接口链接
     * @var string
     */
    private static $webhook = '';

    public static function setConfig(array $config = [])
    {
        if (!empty($config['webhook'])) self::$webhook = $config['webhook'];
    }

    /**
     * 发送钉钉信息
     * @param string $content
     * @return bool
     * @throws DtAppException
     */
    public static function sendText(string $content)
    {
        return Base::text(self::$webhook, $content);
    }
}
