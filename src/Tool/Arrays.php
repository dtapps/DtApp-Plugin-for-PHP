<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 数组
 * Class Arrays
 * @package DtApp\Tool
 */
class Arrays extends Tool
{
    /**
     * 数组随机返回一个下标
     * @param $array
     * @return mixed
     */
    protected static function rand($array)
    {
        return array_rand($array);
    }

    /**
     * 数组随机返回一个值
     * @param $array
     * @return mixed
     */
    protected static function randValue($array)
    {
        return $array[array_rand($array)];
    }
}
