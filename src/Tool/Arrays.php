<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 数组
 * Class Arrays
 * @package DtApp\Tool
 */
class Arrays extends Base
{
    /**
     * 数组随机返回一个
     * @param $array
     * @return mixed
     */
    protected function rand($array)
    {
        return array_rand($array);
    }
}
