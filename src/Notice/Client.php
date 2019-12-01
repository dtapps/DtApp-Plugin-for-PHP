<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

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


    public function __construct(array $config = [])
    {
        if (!empty($config['webhook'])) $this->webhook = $config['webhook'];
        if (!empty($config['api_user'])) $this->api_user = $config['api_user'];
        if (!empty($config['api_key'])) $this->api_key = $config['api_key'];
        if (!empty($config['from'])) $this->from = $config['from'];
        if (!empty($config['from_name'])) $this->from_name = $config['from_name'];
        if (!empty($config['template'])) $this->template = $config['template'];
    }

    public function dingDingText(string $content = '')
    {
        return (new DingDing([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    public function workKileText(string $user, string $content = '')
    {
        return (new WorkKile([
            'webhook' => $this->webhook
        ]))->text($user, $content);
    }

    public function qyWxText(string $content = '')
    {
        return (new QyWeiXin([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    public function qyWxMarkdown(string $content = '')
    {
        return (new QyWeiXin([
            'webhook' => $this->webhook
        ]))->markdown($content);
    }

    public function beAryChatText(string $content = '')
    {
        return (new BeAryChat([
            'webhook' => $this->webhook
        ]))->text($content);
    }

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
