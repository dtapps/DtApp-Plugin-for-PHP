<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\WeChatPay\Mini;


class Client
{
    /**
     * 服务商的APPID
     * @var string
     */
    private $appId = '';

    /**
     * 商户号
     * @var string
     */
    private $mchId = '';

    /**
     * 小程序的APPID
     * @var string
     */
    private $subAppId = '';

    /**
     * 子商户号
     * @var string
     */
    private $subMchId = '';

    /**
     * 是否为测试环境
     * @var bool
     */
    private $milieu = false;

    /**
     * 配置
     * Client constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config['appId'])) $this->appId = $config['appId'];
        if (!empty($config['mchId'])) $this->mchId = $config['mchId'];
        if (!empty($config['subAppId'])) $this->subAppId = $config['subAppId'];
        if (!empty($config['subMchId'])) $this->subMchId = $config['subMchId'];
        if (!empty($config['milieu'])) $this->milieu = $config['milieu'];
    }
}
