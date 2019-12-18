<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;


class Str extends Tool
{
    /**
     * 截取字符串前面n个字符
     * @param string $str 字符串
     * @param int $start_num 开始位置
     * @param int $end_num 多少个
     * @return bool|false|string
     */
    public static function extractBefore(string $str, int $start_num, int $end_num)
    {
        if (strlen($str) < $start_num + $end_num) return $str;
        return substr($str, $start_num, $end_num);
    }

    /**
     * 截取字符串最后n个字符
     * @param string $str 字符串
     * @param int $num 多少个
     * @return false|string
     */
    public static function extractRear(string $str, int $num)
    {
        if (strlen($str) <= $num) return $str;
        return substr($str, -$num);
    }
}
