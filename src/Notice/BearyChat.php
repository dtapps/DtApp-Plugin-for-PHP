<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

/**
 * 倍洽机器人
 * Class BearyChat
 * @package DtApp\Notice
 */
class BearyChat extends Client
{
    /**
     * 倍洽自定义机器人接口链接
     * @var string
     */
    private $webhook = '';

    /**
     * 设置配置
     * BearyChat constructor.
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
     * @return bool 发送结果
     */
    protected function text(string $content)
    {
        return $this->sendMsg([
            'text' => $content
        ]);
    }

    /**
     * 组装发送消息
     * @param array $data 消息内容数组
     * @return bool 发送结果
     */
    private function sendMsg(array $data)
    {
        $result = $this->tool->reqPostHttp($this->webhook, $data, true);
        if ($result['code'] !== 0) return true;
        return false;
    }
}
