<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 22:38
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\Notice;

/**
 * WorkTile
 * Class Worktile
 * @package DtApp\Notice
 */
class Worktile extends Base
{
    /**
     * WorkTile自定义机器人接口链接
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
     * Worktile constructor.
     * @param array $config 配置信息数组
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
    }

    /**
     * 发送文本消息
     * @param string $user 发送对象
     * @param string $content 消息内容
     * @return bool 发送结果
     */
    public function text(string $user, string $content = '')
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
    public function sendMsg(array $data)
    {
        $result = json_decode($this->post_http($this->webhook, $data), true);
        if ($result['code'] == 200) return true;
        $this->error = $result['message'];
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
