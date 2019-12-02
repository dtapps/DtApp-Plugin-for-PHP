<?php
/**
 * PHP常用函数
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
    public function urlLenCode(string $url)
    {
        return (new Url())->lenCode($url);
    }

    /**
     * 编码
     * @param string $url
     * @return string
     */
    public function urlDeCode(string $url)
    {
        return (new Url())->deCode($url);
    }

    /**
     * 数组随机返回一个
     * @param $array
     * @return mixed
     */
    public function arrayRand(array $array)
    {
        return (new Arrays())->rand($array);
    }

    /**
     * 删除文件
     * @param string $name
     * @return bool
     */
    public function fileDelete(string $name)
    {
        return (new File())->delete($name);
    }

    /**
     * 请求的IP
     * @return string|null
     */
    public function ipGet()
    {
        return (new Ip())->get();
    }

    /**
     * 判断一个数是不是偶数
     * @param int $num
     * @return bool
     */
    public function intIsEvenNumbers(int $num)
    {
        return (new IntS())->isEvenNumbers($num);
    }

    /**
     * 判断一个数是不是奇数
     * @param int $num
     * @return bool
     */
    public function intIsOddNumbers(int $num)
    {
        return (new IntS())->isOddNumbers($num);
    }

    /**
     * 截取字符串前面n个字符
     * @param string $str 字符串
     * @param int $start_num 开始位置
     * @param int $end_num 多少个
     * @return bool|false|string
     */
    public function strExtractBefore(string $str, int $start_num, int $end_num)
    {
        return (new Str())->extractBefore($str, $start_num, $end_num);
    }

    /**
     * 截取字符串最后n个字符
     * @param string $str 字符串
     * @param int $num 多少个
     * @return false|string
     */
    public function strExtractRear(string $str, int $num)
    {
        return (new Str())->extractRear($str, $num);
    }

    /**
     * 当前时间
     * @param string $format 格式，默认：Y-m-d H:i:s
     * @return false|string
     */
    public function timeGetData(string $format = 'Y-m-d H:i:s')
    {
        return (new Time())->getData($format);
    }

    /**
     * 当前时间戳
     * @return false|string
     */
    public function timeGetTime()
    {
        return (new Time())->getTime();
    }

    /**
     * 毫秒时间
     * @param string $format 格式 默认：YmdHisu
     * @return false|string
     */
    public function timeGetUDate(string $format = 'YmdHisu')
    {
        return (new Time())->getUDate($format);
    }

    /**
     *  计算两个时间差
     * @param string $end_time 结束时间
     * @param string $start_time 开始时间
     * @return false|int
     */
    public function timeGetTimeDifference(string $end_time, string $start_time = '')
    {
        return (new Time())->getTimeDifference($end_time, $start_time);
    }

    /**
     * 将指定日期转换为时间戳
     * @param string $date
     * @return false|int
     */
    public function timeDateToTimestamp(string $date)
    {
        return (new Time())->dateToTimestamp($date);
    }

    /**
     * 返回Json-成功
     * @param array $data 数据
     * @param string $msg 描述
     * @param int $code 状态
     */
    public function retJsonSuccess(array $data = [], string $msg = 'success', int $code = 0)
    {
        return (new Ret())->jsonSuccess($data, $msg, $code);
    }

    /**
     * 返回Json-错误
     * @param string $msg 描述
     * @param int $code 状态码
     * @param array $data 数据
     */
    public function retJsonError(string $msg = 'error', int $code = 1, array $data = [])
    {
        return (new Ret())->jsonError($msg, $code, $data);
    }

    /**
     * 判断输入的参数
     * @param array $data
     * @param array $arr
     * @return array|bool 有空值就返回false
     */
    public function reqIsEmpty(array $data = [], array $arr = [])
    {
        return (new Req())->isEmpty($data, $arr);
    }

    /**
     * 判断输入的参数为空就返回Json错误
     * @param array $data
     * @param array $arr
     * @return array|bool|void
     */
    public function reqIsEmptyRet(array $data = [], array $arr = [])
    {
        return (new Req())->isEmptyRet($data, $arr);
    }

    /**
     * 判断是否为GET方式
     * @return bool
     */
    public function reqIsGet()
    {
        return (new Req())->isGet();
    }

    /**
     * 判断是否为POST方式
     * @return bool
     */
    public function reqIsPost()
    {
        return (new Req())->isPost();
    }

    /**
     * 判断是否为PUT方式
     * @return boolean
     */
    public function reqIsPut()
    {
        return (new Req())->isPut();
    }

    /**
     * 判断是否为DELETE方式
     * @return boolean
     */
    public function reqIsDelete()
    {
        return (new Req())->isDelete();
    }

    /**
     * 发送GET请求
     * @param string $url 网址
     * @param string $data 参数
     * @param bool $is_json 是否返回Json格式
     * @return bool|mixed|string
     */
    public function reqGetHttp(string $url, $data = '', bool $is_json = null)
    {
        return (new Req())->getHttp($url, $data, $is_json);
    }

    /**
     * 发送Post请求
     * @param string $url 网址
     * @param array $data 参数
     * @param string $headers
     * @param bool $is_json 是否返回Json格式
     * @return array|bool|mixed|string
     */
    public function reqPostHttp(string $url, array $data = [], bool $is_json = null, string $headers = 'application/json;charset=utf-8')
    {
        return (new Req())->postHttp($url, $data, $headers, $is_json);
    }

    /**
     * 验证手机号码
     * @param int $mobile 手机号码
     * @return bool
     */
    public function pregIsIphone(int $mobile)
    {
        return (new Preg())->isIphone($mobile);
    }

    /**
     * 严谨验证手机号码
     * @param int $mobile 手机号码
     * @return bool
     */
    public function pregIsIphoneAll(int $mobile)
    {
        return (new Preg())->isIphoneAll($mobile);
    }

    /**
     * 验证电话号码
     * @param int $tel 电话号码
     * @return bool
     */
    public function pregIsTel(int $tel)
    {
        return (new Preg())->isTel($tel);
    }


    /**
     * 验证身份证号（15位或18位数字）
     * @param int $id 身份证号码
     * @return bool
     */
    public function pregIsIdCard(int $id)
    {
        return (new Preg())->isIdCard($id);
    }

    /**
     * 验证是否是数字(这里小数点会认为是字符)
     * @param $digit
     * @return bool
     */
    public function pregIsDigit($digit)
    {
        return (new Preg())->isDigit($digit);
    }

    /**
     * 验证是否是数字(可带小数点的数字)
     * @param $num
     * @return bool
     */
    public function pregIsNum($num)
    {
        return (new Preg())->isNum($num);
    }

    /**
     * 验证由数字、26个英文字母或者下划线组成的字符串
     * @param $str
     * @return bool
     */
    public function pregIsStr($str)
    {
        return (new Preg())->isStr($str);
    }

    /**
     * 验证用户密码(以字母开头，长度在6-18之间，只能包含字符、数字和下划线)
     * @param $str
     * @return bool
     */
    public function pregIsPassword($str)
    {
        return (new Preg())->isPassword($str);
    }

    /**
     * 验证汉字
     * @param $str
     * @return bool
     */
    public function pregIsChinese($str)
    {
        return (new Preg())->isChinese($str);
    }

    /**
     * 验证Email地址
     * @param $email
     * @return bool
     */
    public function pregIsEmail($email)
    {
        return (new Preg())->isEmail($email);
    }

    /**
     * 验证网址URL
     * @param $url
     * @return bool
     */
    public function pregIsLink($url)
    {
        return (new Preg())->isLink($url);
    }

    /**
     * 腾讯QQ号
     * @param $qq
     * @return bool
     */
    public function pregIsQq($qq)
    {
        return (new Preg())->isQq($qq);
    }

    /**
     * 验证IP地址
     * @param $ip
     * @return bool
     */
    public function pregIsIp($ip)
    {
        return (new Preg())->isIp($ip);
    }

    /**
     * 生成随机字符串（纯数字）
     * @param int $length 长度
     * @return false|string
     */
    public function randomPN($length = 6)
    {
        return (new Random())->random($length, 1);
    }

    /**
     * 生成随机字符串（纯小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public function randomLL($length = 6)
    {
        return (new Random())->random($length, 2);
    }

    /**
     * 生成随机字符串（纯大写字母）
     * @param int $length 长度
     * @return false|string
     */
    public function randomPCL($length = 6)
    {
        return (new Random())->random($length, 3);
    }

    /**
     * 生成随机字符串（数字和小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public function randomNALL($length = 6)
    {
        return (new Random())->random($length, 4);
    }

    /**
     * 生成随机字符串（数字和大写字母）
     * @param int $length 长度
     * @return false|string
     */
    public function randomNACL($length = 6)
    {
        return (new Random())->random($length, 5);
    }

    /**
     * 生成随机字符串（大小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public function randomUALL($length = 6)
    {
        return (new Random())->random($length, 6);
    }

    /**
     * 生成随机字符串（数字和大小写字母）
     * @param int $length 长度
     * @return false|string
     */
    public function randomNAUALL($length = 6)
    {
        return (new Random())->random($length, 7);
    }
}
