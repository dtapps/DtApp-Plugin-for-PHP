<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Notice;

use DtApp\Tool\Tool;

/**
 * 通知中间
 * Class Base
 * @package DtApp\Notice
 */
class Base extends Client
{
    protected $tool;

    /**
     * sendcloud网址
     * @var type
     */
    protected $sendcloud_url = 'https://api.sendcloud.net/apiv2/mail/sendtemplate';

    public function __construct(array $config = [])
    {
        $this->tool = new Tool();
        parent::__construct($config);
    }
}
