<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

/**
 * 钉钉
 * Class DingDing
 * @package DtApp\Notice
 */
class DingDing extends Base
{
    /**
     * 钉钉自定义机器人接口链接
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
     * DingDing constructor.
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
    protected function text(string $content)
    {
        $this->msgType = 'text';
        return $this->sendMsg([
            'text' => [
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
