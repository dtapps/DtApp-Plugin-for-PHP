<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice\DingTalk;


use DtApp\Notice\DingDingClient;
use DtApp\Tool\DtAppException;
use DtApp\Tool\Tool;

class Base extends DingDingClient
{
    /**
     * 消息类型
     * @var string
     */
    private static $msgType = 'text';

    /**
     * 发送文本消息
     * @param string $webhook
     * @param string $content 消息内容
     * @return bool    发送结果
     * @throws DtAppException
     */
    protected static function text(string $webhook, string $content)
    {
        self::$msgType = 'text';
        return self::sendMsg($webhook, [
            'text' => [
                'content' => $content,
            ],
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
        if (empty($data['msgtype'])) $data['msgtype'] = self::$msgType;
        $result = Tool::reqPostHttp($webhook, $data, true);
        if ($result['errcode'] == 0) return true;
        return false;
    }
}
