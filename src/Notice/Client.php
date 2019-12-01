<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

/**
 * 通知模块
 * Class Client
 * @package DtApp\Notice
 */
class Client
{
    /**
     * 接口链接
     * @var string
     */
    private $webhook = '';

    /**
     * apiUser
     * @var string
     */
    private $api_user = '';

    /**
     * apiKey
     * @var string
     */
    private $api_key = '';

    /**
     * 发件人地址
     * @var string
     */
    private $from = '';

    /**
     * 发件人名称
     * @var string
     */
    private $from_name = '';

    /**
     * 邮件模板调用名称
     * @var string
     */
    private $template = '';

    /**
     * 配置
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
        if (!empty($config['api_user'])) $this->api_user = $config['api_user'];
        if (!empty($config['api_key'])) $this->api_key = $config['api_key'];
        if (!empty($config['from'])) $this->from = $config['from'];
        if (!empty($config['from_name'])) $this->from_name = $config['from_name'];
        if (!empty($config['template'])) $this->template = $config['template'];
    }

    /**
     * 发送钉钉信息
     * @param string $content
     * @return bool
     */
    public function dingDingText(string $content = '')
    {
        return (new DingDing([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    /**
     * 发送WorkKile信息
     * @param string $user
     * @param string $content
     * @return bool
     */
    public function workKileText(string $user, string $content = '')
    {
        return (new WorkKile([
            'webhook' => $this->webhook
        ]))->text($user, $content);
    }

    /**
     * 发送企业微信信息
     * @param string $content
     * @return bool
     */
    public function qyWxText(string $content = '')
    {
        return (new QyWeiXin([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    /**
     * 发送企业微信markdown信息
     * @param string $content
     * @return bool
     */
    public function qyWxMarkdown(string $content = '')
    {
        return (new QyWeiXin([
            'webhook' => $this->webhook
        ]))->markdown($content);
    }

    /**
     * 发送倍洽信息
     * @param string $content
     * @return bool
     */
    public function beAryChatText(string $content = '')
    {
        return (new BeAryChat([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    /**
     * 发送邮箱信息
     * @param string $email
     * @param string $title
     * @param string $desc
     * @param array $content
     * @return bool
     */
    public function sendCloudSend(string $email, string $title, string $desc, array $content)
    {
        return (new SendCloud([
            'api_user' => $this->api_user,
            'api_key' => $this->api_key,
            'from' => $this->from,
            'from_name' => $this->from_name,
            'template' => $this->template,
        ]))->send($email, $title, $desc, $content);
    }
}
