<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 网址方法
 * Class Url
 * @package DtApp\Tool
 */
class Url extends Tool
{

    /**
     * @param string $url
     * @return string
     */
    protected static function lenCode(string $url)
    {
        if (empty($url)) return false;
        return urlencode($url);
    }

    /**
     * 解码
     * @param string $url
     * @return string
     */
    protected static function deCode(string $url)
    {
        if (empty($url)) return false;
        return urldecode($url);
    }

    /**
     * 格式化参数格式化成url参数
     * @param array $data
     * @return string
     */
    protected static function toParams(array $data)
    {
        $buff = "";
        foreach ($data as $k => $v) if ($k != "sign" && $v !== "" && !is_array($v)) $buff .= $k . "=" . $v . "&";
        $buff = trim($buff, "&");
        return $buff;
    }
}
