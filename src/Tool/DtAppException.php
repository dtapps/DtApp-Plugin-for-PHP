<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

use Exception;

/**
 * 处理错误
 * Class DtAppException
 * @package DtApp\Tool
 */
class DtAppException extends Exception
{
    public function errorMessage()
    {
        return $this->getMessage();
    }
}
