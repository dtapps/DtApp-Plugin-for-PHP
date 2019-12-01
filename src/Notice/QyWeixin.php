<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

/**
 * 企业微信
 * Class QyWeixin
 * @package DtApp\Notice
 */
class QyWeixin extends Client
{
    /**
     * 企业微信自定义机器人接口链接
     * @var string
     */
    private $webhook = '';

    /**
     * 消息类型
     * @var string
     */
    private $msgType = 'text';

    /**
     * 设置配置
     * QyWeixin constructor.
     * @param array $config 配置信息数组
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
        parent::__construct($config);
    }

    /**
     * 发送文本消息
     * @param string $content 消息内容
     * @return bool    发送结果
     */
    protected function text(string $content = '')
    {
        $this->msgType = 'text';
        return $this->sendMsg([
            'text' => [
                'content' => $content,
            ],
        ]);
    }

    /**
     * 发送markdown消息
     *
     * @param string $content 消息内容
     * @return bool    发送结果
     */
    protected function markdown(string $content = '')
    {
        $this->msgType = 'markdown';
        return $this->sendMsg([
            'markdown' => [
                'content' => $content,
            ],
        ]);
    }

    /**
     * 组装发送消息
     * @param array $data 消息内容数组
     * @return bool 发送结果
     */
    private function sendMsg(array $data)
    {
        if (empty($data['msgtype'])) $data['msgtype'] = $this->msgType;
        $result = $this->tool->reqPostHttp($this->webhook, $data, true);
        if ($result['errcode'] == 0) return true;
        return false;
    }
}
