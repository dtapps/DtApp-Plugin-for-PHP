<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 数字
 * Class IntS
 * @package DtApp\Tool
 */
class IntS extends Base
{
    /**
     * 判断一个数是不是偶数
     * @param int $num
     * @return bool
     */
    protected function isEvenNumbers(int $num)
    {
        if ($num % 2 == 0) return true;
        return false;
    }

    /**
     * 判断一个数是不是奇数
     * @param int $num
     * @return bool
     */
    protected function isOddNumbers(int $num)
    {
        if ($num % 2 == 0) return false;
        return true;
    }
}
