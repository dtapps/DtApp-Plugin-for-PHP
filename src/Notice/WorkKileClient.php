<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice;


use DtApp\Notice\WorkKile\Base;
use DtApp\Tool\DtAppException;

class WorkKileClient
{
    /**
     * WorkTile自定义机器人接口链接
     * @var string
     */
    private static $webhook = '';

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig(array $config = [])
    {
        if (!empty($config['webhook'])) self::$webhook = $config['webhook'];
    }

    /**
     * 发送WorkKile信息
     * @param string $user
     * @param string $content
     * @return bool
     * @throws DtAppException
     */
    public static function sendText(string $user, string $content = '')
    {
        return Base::text(self::$webhook, $user, $content);
    }
}
