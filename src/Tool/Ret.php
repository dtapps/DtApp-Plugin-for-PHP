<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 22:36
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\Tool;

/**
 * 返回
 * Class Ret
 * @package DtApp\Tool
 */
class Ret
{
    /**
     * 返回Json-成功
     * @param array $data 数据
     * @param string $msg 描述
     * @param int $code 状态
     */
    public static function jsonSuccess(array $data = [], string $msg = 'success', int $code = 0)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
        exit();
    }

    /**
     * 返回Json-错误
     * @param string $msg 描述
     * @param int $code 状态码
     */
    /**
     * 返回Json-错误
     * @param string $msg 描述
     * @param int $code 状态码
     * @param array $data 数据
     */
    public static function jsonError(string $msg = 'error', int $code = 1, array $data = [])
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]);
        exit();
    }
}
