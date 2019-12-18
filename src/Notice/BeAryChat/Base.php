<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice\BeAryChat;


use DtApp\Notice\BeAryChatClient;
use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

class Base extends BeAryChatClient
{
    /**
     * 发送文本消息
     * @param string $webhook
     * @param string $content 消息内容
     * @return bool 发送结果
     * @throws DtAppException
     */
    protected static function text(string $webhook, string $content)
    {
        return self::sendMsg($webhook, [
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
        if ($result['code'] !== 0) return true;
        return false;
    }
}
