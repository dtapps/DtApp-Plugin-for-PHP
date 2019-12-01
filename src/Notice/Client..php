<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

class Client extends Base
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

    public function WorkKileText(string $user, string $content = '')
    {
        return (new Worktile([
            'webhook' => $this->webhook
        ]))->text($user, $content);
    }

    public function QyWxText(string $content = '')
    {
        return (new QyWeixin([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    public function QyWxMarkdown(string $content = '')
    {
        return (new QyWeixin([
            'webhook' => $this->webhook
        ]))->markdown($content);
    }

    public function BeAryChatText(string $content = '')
    {
        return (new BearyChat([
            'webhook' => $this->webhook
        ]))->text($content);
    }

    public function SendCloudSend(string $email, string $title, string $desc, array $content)
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
