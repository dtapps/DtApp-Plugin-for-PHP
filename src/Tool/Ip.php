<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 查询IP
 * Class Ip
 * @package DtApp\Tool
 */
class Ip extends Tool
{
    /**
     * 请求的IP
     * @return string|null
     */
    protected static function get()
    {
        if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['REMOTE_ADDR'];
        //为了兼容百度的CDN，所以转成数组
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return $arr[0];
    }
}
