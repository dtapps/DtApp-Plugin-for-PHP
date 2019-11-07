<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 22:38
 * User: 李光春 gc@dtapp.net
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
    protected $webhook = '';

    /**
     * 消息类型
     * @var string
     */
    protected $msgType = 'text';

    /**
     * 错误消息
     * @var string
     */
    protected $error = '';

    /**
     * 初始化
     * @return $this
     */
    public function init()
    {
        return $this;
    }

    /**
     * 设置配置
     * DingDing constructor.
     * @param array $config 配置信息数组
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
    }

    /**
     * 发送文本消息
     * @param string $content 消息内容
     * @return bool    发送结果
     */
    public function text(string $content = '')
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
    public function sendMsg(array $data)
    {
        if (empty($data['msgtype'])) $data['msgtype'] = $this->msgType;
        $this->init();
        $result = json_decode($this->post_http($this->webhook, $data), true);
        if ($result['errcode'] == 0) return true;
        $this->error = $result['errmsg'];
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
