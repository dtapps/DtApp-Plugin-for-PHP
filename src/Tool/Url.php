<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Tool;

/**
 * 网址方法
 * Class Url
 * @package DtApp\Tool
 */
class Url extends Base
{

    /**
     * @param string $url
     * @return string
     */
    protected function lenCode(string $url)
    {
        return urlencode($url);
    }

    /**
     * 解码
     * @param string $url
     * @return string
     */
    protected function deCode(string $url)
    {
        return urldecode($url);
    }
}
