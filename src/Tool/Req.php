<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 请求
 * Class Req
 * @package DtApp\Tool
 */
class Req extends Base
{
    /**
     * 判断输入的参数
     * @param array $data
     * @param array $arr
     * @return array|bool 有空值就返回false
     */
    protected function isEmpty(array $data, array $arr)
    {
        foreach ($arr as $k => $v) if (empty(isset($data["$v"]) ? $data["$v"] : '')) return false;
        return $data;
    }

    /**
     * 判断输入的参数为空就返回Json错误
     * @param array $data
     * @param array $arr
     * @return array|bool
     */
    protected function isEmptyRet(array $data, array $arr)
    {
        foreach ($arr as $k => $v) if (empty(isset($data["$v"]) ? $data["$v"] : '')) (new Ret())->retJsonError('请检查参数', 102);
        return $data;
    }

    /**
     * 判断是否为GET方式
     * @return bool
     */
    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * 判断是否为POST方式
     * @return bool
     */
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    /**
     * 判断是否为PUT方式
     * @return boolean
     */
    protected function isPut()
    {
        return $_SERVER['REQUEST_METHOD'] == 'PUT' ? true : false;
    }

    /**
     * 判断是否为DELETE方式
     * @return boolean
     */
    protected function isDelete()
    {
        return $_SERVER['REQUEST_METHOD'] == 'DETELE' ? true : false;
    }

    /**
     * 取域名地址
     * @return string
     */
    protected function websiteAddress()
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http_type . $_SERVER['HTTP_HOST'] . "/";
    }

    /**
     * 发送GET请求
     * @param string $url 网址
     * @param string $data 参数
     * @param bool $is_json 是否返回Json格式
     * @return bool|mixed|string
     */
    protected function getHttp(string $url, string $data, bool $is_json)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        if (empty($is_json)) return $output;
        try {
            return json_decode($output, true);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 发送Post请求
     * @param string $url 网址
     * @param array $post_data 参数
     * @param string $headers
     * @param bool $is_json 是否返回Json格式
     * @return array|bool|mixed|string
     */
    protected function postHttp(string $url, array $post_data, string $headers, bool $is_json)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: ' . $headers));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        $content = curl_exec($ch);
        curl_close($ch);
        if (empty($is_json)) return $content;
        try {
            return json_decode($content, true);
        } catch (\Exception $e) {
            return false;
        }
    }
}
