<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice;


use DtApp\Notice\BeAryChat\Base;
use DtApp\Tool\DtAppException;

class BeAryChatClient
{
    /**
     * 倍洽自定义机器人接口链接
     * @var string
     */
    private static $webhook = '';

    public static function setConfig(array $config = [])
    {
        if (!empty($config['webhook'])) self::$webhook = $config['webhook'];
    }

    /**
     * 发送倍洽信息
     * @param string $content
     * @return bool
     * @throws DtAppException
     */
    public static function sendText(string $content)
    {
        return Base::text(self::$webhook, $content);
    }
}
