<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

use DtApp\Tool\Tool;

/**
 * 中间件
 * Class Base
 * @package DtApp\Notice
 */
class Base extends Client
{
    /**
     * 工具
     * @var Tool
     */
    protected $tool;

    /**
     * sendcloud网址
     * @var type
     */
    protected $sendcloud_url = 'https://api.sendcloud.net/apiv2/mail/sendtemplate';

    /**
     * 配置
     * Base constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->tool = new Tool();
        parent::__construct($config);
    }
}
