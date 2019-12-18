<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 工具
 * Class Tool
 * @package DtApp\Tool
 */
class Tool
{
    /**
     * 编码
     * @param string $url
     * @return string
     */
    public static function urlLenCode(string $url)
    {
        return Url::lenCode($url);
    }

    /**
     * 编码
     * @param string $url
     * @return string
     */
    public static function urlDeCode(string $url)
    {
        return Url::deCode($url);
    }

    /**
     * 格式化参数格式化成url参数
     * @param array $data
     * @return string
     */
    public static function urlToParams(array $data)
    {
        return Url::toParams($data);
    }

    /**
     * 数组随机返回一个
     * @param $array
     * @return mixed
     */
    public static function arrayRand(array $array)
    {
        return Arrays::rand($array);
    }

    /**
     * 删除文件
     * @param string $name
     * @return bool
     */
    public static function fileDelete(string $name)
    {
        return File::delete($name);
    }

    /**
     * 请求的IP
     * @return string|null
     */
    public static function ipGet()
    {
        return Ip::get();
    }

    /**
     * 判断一个数是不是偶数
     * @param int $num
     * @return bool
     */
    public static function intIsEvenNumbers(int $num)
    {
        return IntS::isEvenNumbers($num);
    }

    /**
     * 判断一个数是不是奇数
     * @param int $num
     * @return bool
     */
    public static function intIsOddNumbers(int $num)
    {
        return IntS::isOddNumbers($num);
    }

    /**
     * 截取字符串前面n个字符
     * @param string $str 字符串
     * @param int $start_num 开始位置
     * @param int $end_num 多少个
     * @return bool|false|string
     */
    public static function strExtractBefore(string $str, int $start_num, int $end_num)
    {
        return Str::extractBefore($str, $start_num, $end_num);
    }

    /**
     * 截取字符串最后n个字符
     * @param string $str 字符串
     * @param int $num 多少个
     * @return false|string
     */
    public static function strExtractRear(string $str, int $num)
    {
        return Str::extractRear($str, $num);
    }

    /**
     * 当前时间
     * @param string $format 格式，默认：Y-m-d H:i:s
     * @return false|string
     */
    public static function timeGetData(string $format = 'Y-m-d H:i:s')
    {
        return Time::getData($format);
    }

    /**
     * 当前时间戳
     * @return false|string
     */
    public static function timeGetTime()
    {
        return Time::getTime();
    }

    /**
     * 毫秒时间
     * @return false|string
     */
    public static function timeGetUDate()
    {
        return Time::getUDate();
    }

    /**
     *  计算两个时间差
     * @param string $end_time 结束时间
     * @param string $start_time 开始时间
     * @return false|int
     */
    public static function timeGetTimeDifference(string $end_time, string $start_time = '')
    {
        return Time::getTimeDifference($end_time, $start_time);
    }

    /**
     * 将指定日期转换为时间戳
     * @param string $date
     * @return false|int
     */
    public static function timeDateToTimestamp(string $date)
    {
        return Time::dateToTimestamp($date);
    }

    /**
     * 获取某个时间之后的时间
     * @param string $format
     * @param int $mun
     * @return false|int
     */
    public static function timeDateRear(string $format = "Y-m-d H:i:s", int $mun = 10)
    {
        return Time::dateRear($format, $mun);
    }

    /**
     * 获取某个时间之前的时间
     * @param string $format
     * @param int $mun
     * @return false|int
     */
    public static function timeDateBefore(string $format = "Y-m-d H:i:s", int $mun = 10)
    {
        return Time::dateBefore($format, $mun);
    }

    /**
     * 返回Json-成功
     * @param array $data 数据
     * @param string $msg 描述
     * @param int $code 状态
     */
    public static function retJsonSuccess(array $data = [], string $msg = 'success', int $code = 0)
    {
        return Ret::jsonSuccess($data, $msg, $code);
    }

    /**
     * 返回Json-错误
     * @param string $msg 描述
     * @param int $code 状态码
     * @param array $data 数据
     */
    public static function retJsonError(string $msg = 'error', int $code = 1, array $data = [])
    {
        return Ret::jsonError($msg, $code, $data);
    }

    /**
     * 判断输入的参数
     * @param array $data
     * @param array $arr
     * @return array|bool 有空值就返回false
     */
    public static function reqIsEmpty(array $data = [], array $arr = [])
    {
        return Req::isEmpty($data, $arr);
    }

    /**
     * 判断输入的参数为空就返回Json错误
     * @param array $data
     * @param array $arr
     * @return array|bool|void
     */
    public static function reqIsEmptyRet(array $data = [], array $arr = [])
    {
        return Req::isEmptyRet($data, $arr);
    }

    /**
     * 判断是否为GET方式
     * @return bool
     */
    public static function reqIsGet()
    {
        return Req::isGet();
    }

    /**
     * 判断是否为POST方式
     * @return bool
     */
    public static function reqIsPost()
    {
        return Req::isPost();
    }

    /**
     * 判断是否为PUT方式
     * @return boolean
     */
    public static function reqIsPut()
    {
        return Req::isPut();
    }

    /**
     * 判断是否为DELETE方式
     * @return boolean
     */
    public static function reqIsDelete()
    {
        return Req::isDelete();
    }

    /**
     * 发送GET请求
     * @param string $url 网址
     * @param string $data 参数
     * @param bool $is_json 是否返回Json格式
     * @return bool|mixed|string
     * @throws DtAppException
     */
    public static function reqGetHttp(string $url, $data = '', bool $is_json = false)
    {
        return Req::getHttp($url, $data, $is_json);
    }

    /**
     * 发送Post请求
     * @param string $url 网址
     * @param array $data 参数
     * @param string $headers
     * @param bool $is_json 是否返回Json格式
     * @return array|bool|mixed|string
     * @throws DtAppException
     */
    public static function reqPostHttp(string $url, array $data = [], bool $is_json = false, string $headers = 'application/json;charset=utf-8')
    {
        return Req::postHttp($url, $data, $headers, $is_json);
    }

    /**
     * 发送xml数据
     * @param string $url
     * @param string $data
     * @param string $headers
     * @return string
     * @throws DtAppException
     */
    public static function reqPostXmlHttp(string $url, string $data = '', string $headers = 'application/json;charset=utf-8')
    {
        return Req::postXml($url, $data, $headers);
    }

    /**
     * 验证手机号码
     * @param int $mobile 手机号码
     * @return bool
     */
    public static function pregIsIphone(int $mobile)
    {
        return Preg::isIphone($mobile);
    }

    /**
     * 严谨验证手机号码
     * @param int $mobile 手机号码
     * @return bool
     */
    public static function pregIsIphoneAll(int $mobile)
    {
        return Preg::isIphoneAll($mobile);
    }

    /**
     * 验证电话号码
     * @param int $tel 电话号码
     * @return bool
     */
    public static function pregIsTel(int $tel)
    {
        return Preg::isTel($tel);
    }


    /**
     * 验证身份证号（15位或18位数字）
     * @param int $id 身份证号码
     * @return bool
     */
    public static function pregIsIdCard(int $id)
    {
        return Preg::isIdCard($id);
    }

    /**
     * 验证是否是数字(这里小数点会认为是字符)
     * @param $digit
     * @return bool
     */
    public static function pregIsDigit($digit)
    {
        return Preg::isDigit($digit);
    }

    /**
     * 验证是否是数字(可带小数点的数字)
     * @param $num
     * @return bool
     */
    public static function pregIsNum($num)
    {
        return Preg::isNum($num);
    }

    /**
     * 验证由数字、26个英文字母或者下划线组成的字符串
     * @param $str
     * @return bool
     */
    public static function pregIsStr($str)
    {
        return Preg::isStr($str);
    }

    /**
     * 验证用户密码(以字母开头，长度在6-18之间，只能包含字符、数字和下划线)
     * @param $str
     * @return bool
     */
    public static function pregIsPassword($str)
    {
        return Preg::isPassword($str);
    }

    /**
     * 验证汉字
     * @param $str
     * @return bool
     */
    public static function pregIsChinese($str)
    {
        return Preg::isChinese($str);
    }

    /**
     * 验证Email地址
     * @param $email
     * @return bool
     */
    public static function pregIsEmail($email)
    {
        return Preg::isEmail($email);
    }

    /**
     * 验证网址URL
     * @param $url
     * @return bool
     */
    public static function pregIsLink($url)
    {
        return Preg::isLink($url);
    }

    /**
     * 腾讯QQ号
     * @param $qq
     * @return bool
     */
    public static function pregIsQq($qq)
    {
        return Preg::isQq($qq);
    }

    /**
     * 验证IP地址
     * @param $ip
     * @return bool
     */
    public static function pregIsIp($ip)
    {
        return Preg::isIp($ip);
    }

    /**
     * 生成随机字符串（纯数字）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomPN($length = 6)
    {
        return Random::random($length, 1);
    }

    /**
     * 生成随机字符串（纯小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomLL($length = 6)
    {
        return Random::random($length, 2);
    }

    /**
     * 生成随机字符串（纯大写字母）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomPCL($length = 6)
    {
        return Random::random($length, 3);
    }

    /**
     * 生成随机字符串（数字和小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomNALL($length = 6)
    {
        return Random::random($length, 4);
    }

    /**
     * 生成随机字符串（数字和大写字母）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomNACL($length = 6)
    {
        return Random::random($length, 5);
    }

    /**
     * 生成随机字符串（大小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomUALL($length = 6)
    {
        return Random::random($length, 6);
    }

    /**
     * 生成随机字符串（数字和大小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public static function randomNAUALL($length = 6)
    {
        return Random::random($length, 7);
    }

    /**
     * 取域名地址
     * @return string
     */
    public static function reqGetWebsiteAddress()
    {
        return Req::websiteAddress();
    }

    /**
     * 数组转换为xml
     * @param array $data
     * @return string
     * @throws DtAppException
     */
    public static function xmlArrayToXml(array $data = [])
    {
        return Xml::toXml($data);
    }

    /**
     * 将XML转为array
     * @param string $data
     * @return string
     * @throws DtAppException
     */
    public static function xmlXmlToArray(string $data = '')
    {
        return Xml::toArray($data);
    }

    /**
     * 上传图片
     * @param string $url
     * @param array $data
     * @param string $sslCertPath
     * @param string $sslKeyPath
     * @param bool $userCert
     * @param string $headers
     * @param int $timeout
     * @return string
     * @throws DtAppException
     */
    public static function reqPostFile(string $url, array $data, string $sslCertPath, string $sslKeyPath, bool $userCert = true, string $headers = 'multipart/form-data', int $timeout = 30)
    {
        return Req::postFile($url, $data, $headers, $userCert, $timeout, $sslCertPath, $sslKeyPath);
    }
}
