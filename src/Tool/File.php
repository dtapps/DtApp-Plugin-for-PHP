<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 文件
 * Class File
 * @package DtApp\Tool
 */
class File extends Base
{
    /**
     * 删除文件
     * @param string $name
     * @return bool
     */
    protected function delete(string $name)
    {
        if (file_exists($name)) {
            $res = unlink($name);
            if ($res) return true;
        }
        return false;
    }
}
