<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 数字
 * Class IntS
 * @package DtApp\Tool
 */
class IntS extends Tool
{
    /**
     * 判断一个数是不是偶数
     * @param int $num
     * @return bool
     */
    protected static function isEvenNumbers(int $num)
    {
        if ($num % 2 == 0) return true;
        return false;
    }

    /**
     * 判断一个数是不是奇数
     * @param int $num
     * @return bool
     */
    protected static function isOddNumbers(int $num)
    {
        if ($num % 2 == 0) return false;
        return true;
    }
}
