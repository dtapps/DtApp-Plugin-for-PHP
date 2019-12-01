<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 查询IP
 * Class Ip
 * @package DtApp\Tool
 */
class Ip extends Base
{
    /**
     * 请求的IP
     * @return string|null
     */
    protected function get()
    {
        if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['REMOTE_ADDR'];
        //为了兼容百度的CDN，所以转成数组
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return $arr[0];
    }
}
