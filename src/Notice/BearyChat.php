<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 22:38
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\Notice;

/**
 * 倍洽机器人
 * Class BearyChat
 * @package DtApp\Notice
 */
class BearyChat extends Base
{
    /**
     * 倍洽自定义机器人接口链接
     * @var string
     */
    protected $webhook = '';

    /**
     * 错误信息
     * @var string
     */
    protected $error = '';

    /**
     * 设置配置
     * BearyChat constructor.
     * @param array $config 配置信息数组
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
    }

    /**
     * 发送文本消息
     * @param string $content 消息内容
     * @return bool 发送结果
     */
    public function text(string $content = '')
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
    public function sendMsg(array $data)
    {
        $result = json_decode($this->post_http($this->webhook, $data), true);
        if ($result['code'] !== 0) return true;
        $this->error = $result['result'];
        return false;

    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }
}
