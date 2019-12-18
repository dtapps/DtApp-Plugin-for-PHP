<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 返回
 * Class Ret
 * @package DtApp\Tool
 */
class Ret extends Tool
{
    /**
     * 返回Json-成功
     * @param array $data 数据
     * @param string $msg 描述
     * @param int $code 状态
     */
    protected static function jsonSuccess(array $data, string $msg, int $code)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
        exit;
    }

    /**
     * 返回Json-错误
     * @param string $msg 描述
     * @param int $code 状态码
     * @param array $data 数据
     */
    protected static function jsonError(string $msg, int $code, array $data)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
        exit;
    }
}
