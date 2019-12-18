<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 请求
 * Class Req
 * @package DtApp\Tool
 */
class Req extends Tool
{
    /**
     * 判断输入的参数
     * @param array $data
     * @param array $arr
     * @return array|bool 有空值就返回false
     */
    protected static function isEmpty(array $data, array $arr)
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
    protected static function isEmptyRet(array $data, array $arr)
    {
        foreach ($arr as $k => $v) if (empty(isset($data["$v"]) ? $data["$v"] : '')) Tool::retJsonError('请检查参数', 102);
        return $data;
    }

    /**
     * 判断是否为GET方式
     * @return bool
     */
    protected static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * 判断是否为POST方式
     * @return bool
     */
    protected static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    /**
     * 判断是否为PUT方式
     * @return boolean
     */
    protected static function isPut()
    {
        return $_SERVER['REQUEST_METHOD'] == 'PUT' ? true : false;
    }

    /**
     * 判断是否为DELETE方式
     * @return boolean
     */
    protected static function isDelete()
    {
        return $_SERVER['REQUEST_METHOD'] == 'DETELE' ? true : false;
    }

    /**
     * 取域名地址
     * @return string
     */
    protected static function websiteAddress()
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
     * @throws DtAppException
     */
    protected static function getHttp(string $url, string $data, bool $is_json)
    {
        if (!extension_loaded("curl")) throw new DtAppException('请开启curl模块！', E_USER_DEPRECATED);
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
     * @throws DtAppException
     */
    protected static function postHttp(string $url, array $post_data, string $headers, bool $is_json)
    {
        if (!extension_loaded("curl")) throw new DtAppException('请开启curl模块！', E_USER_DEPRECATED);
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

    /**
     * 发送Xml数据
     * @param string $url
     * @param string $xmlData
     * @param string $headers
     * @param int $second 设置超时
     * @return string
     * @throws DtAppException
     */
    protected static function postXml(string $url, string $xmlData, string $headers, $second = 60)
    {
        //首先检测是否支持curl
        if (!extension_loaded("curl")) throw new DtAppException('请开启curl模块！', E_USER_DEPRECATED);
        //初始一个curl会话
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        set_time_limit(0);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: ' . $headers));
        }
        //运行curl
        $data = curl_exec($ch);
        curl_close($ch);
        return Tool::xmlXmlToArray($data);
    }

    /**
     * 上传图片
     * @param string $url
     * @param array $post_data
     * @param string $headers
     * @param bool $userCert
     * @param int $timeout
     * @param $sslCertPath
     * @param $sslKeyPath
     * @return string
     * @throws DtAppException
     */
    protected static function postFile(string $url, $post_data = [], string $headers = '', $userCert = false, $timeout = 30, $sslCertPath, $sslKeyPath)
    {
        //首先检测是否支持curl
        if (!extension_loaded("curl")) throw new DtAppException('请开启curl模块！', E_USER_DEPRECATED);
        //初始一个curl会话
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (!empty($xmlData)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELD, $post_data);
        }
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        if ($userCert) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLCERT, $sslCertPath);
            curl_setopt($ch, CURLOPT_SSLKEY, $sslKeyPath);
        } else {
            if (substr($url, 0, 5) == 'https') {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名
            }
        }
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: ' . $headers));
        }
        curl_setopt($ch, CURLOPT_HEADER, true);    // 是否需要响应 header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);    // 获得响应结果里的：头大小
        $response_header = substr($output, 0, $header_size);    // 根据头大小去获取头信息内容
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);    // 获取响应状态码
        $response_body = substr($output, $header_size);
        $error = curl_error($ch);
        curl_close($ch);
        $data = [
            'request_url' => $url,
            'request_body' => serialize($post_data),
            'request_header' => serialize($headers),
            'response_http_code' => $http_code,
            'response_body' => serialize($response_body),
            'response_header' => serialize($response_header),
        ];
        var_dump($data);
        return Tool::xmlXmlToArray($response_body);
    }
}
