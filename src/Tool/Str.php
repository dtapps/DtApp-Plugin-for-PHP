<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/16
 * Time: 21:37
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\Tool;


class Str
{
    /**
     * 截取字符串前面n个字符
     * @param string $str 字符串
     * @param int $start_num 开始位置
     * @param int $end_num 多少个
     * @return bool|false|string
     */
    public static function strExtractBefore(string $str, int $start_num, int $end_num)
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
    public static function strExtractRear(string $str, int $num)
    {
        if (strlen($str) <= $num) return $str;
        return substr($str, -$num);
    }
}
