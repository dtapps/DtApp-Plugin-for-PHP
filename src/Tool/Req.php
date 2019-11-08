<?php

/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 22:36
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\Tool;

/**
 * 请求
 * Class Req
 * @package DtApp\Tool
 */
class Req
{
    /**
     * 判断输入的参数
     * @param array $data
     * @param array $arr
     * @return array|bool 有空值就返回false
     */
    public static function isEmpty(array $data = [], array $arr = [])
    {
        foreach ($arr as $k => $v) {
            if (empty(isset($data["$v"]) ? $data["$v"] : '')) return false;
        }
        return $data;
    }

    /**
     * 判断输入的参数为空就返回Json错误
     * @param array $data
     * @param array $arr
     * @return array 有空值就输出Json错误
     */
    public static function isEmptyRet(array $data = [], array $arr = [])
    {
        foreach ($arr as $k => $v) {
            if (empty(isset($data["$v"]) ? $data["$v"] : '')) Ret::jsonError('请检查参数', 102);
        }
        return $data;
    }

    /**
     * 判断是否为GET方式
     * @return bool
     */
    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * 判断是否为POST方式
     * @return bool
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    /**
     * 判断是否为PUT方式
     *
     * @return boolean
     */
    public function isPut()
    {
        return $_SERVER['REQUEST_METHOD'] == 'PUT' ? true : false;
    }

    /**
     * 判断是否为DELETE方式
     *
     * @return boolean
     */
    public function isDelete()
    {
        return $_SERVER['REQUEST_METHOD'] == 'DETELE' ? true : false;
    }
}
