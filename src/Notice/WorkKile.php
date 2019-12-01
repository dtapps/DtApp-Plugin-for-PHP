<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

/**
 * WorkTile
 * Class WorkKile
 * @package DtApp\Notice
 */
class WorkKile extends Base
{
    /**
     * WorkTile自定义机器人接口链接
     * @var string
     */
    private $webhook = '';

    /**
     * 设置配置
     * Worktile constructor.
     * @param array $config 配置信息数组
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
        parent::__construct($config);
    }

    /**
     * 发送文本消息
     * @param string $user 发送对象
     * @param string $content 消息内容
     * @return bool 发送结果
     */
    protected function text(string $user, string $content)
    {
        return $this->sendMsg([
            'user' => $user,
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
        if ($result['code'] == 200) return true;
        return false;
    }
}
