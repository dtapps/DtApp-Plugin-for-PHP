<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice\WorkKile;


use DtApp\Notice\WorkKileClient;
use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

class Base extends WorkKileClient
{
    /**
     * 发送文本消息
     * @param string $webhook
     * @param string $user 发送对象
     * @param string $content 消息内容
     * @return bool 发送结果
     * @throws DtAppException
     */
    protected static function text(string $webhook, string $user, string $content)
    {
        return self::sendMsg($webhook, [
            'user' => $user,
            'text' => $content
        ]);
    }

    /**
     * 组装发送消息
     * @param string $webhook
     * @param array $data 消息内容数组
     * @return bool 发送结果
     * @throws DtAppException
     */
    private static function sendMsg(string $webhook, array $data)
    {
        $result = Tool::reqPostHttp($webhook, $data, true);
        if ($result['code'] == 200) return true;
        return false;
    }
}
