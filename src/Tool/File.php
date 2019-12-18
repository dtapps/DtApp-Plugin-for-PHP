<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 文件
 * Class File
 * @package DtApp\Tool
 */
class File extends Tool
{
    /**
     * 删除文件
     * @param string $name
     * @return bool
     */
    protected static function delete(string $name)
    {
        if (file_exists($name)) if (unlink($name)) return true;
        return false;
    }
}
