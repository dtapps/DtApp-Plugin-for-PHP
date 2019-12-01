<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 正则验证
 * Class Preg
 * @package DtApp\Tool
 */
class Preg extends Base
{
    /**
     * 验证手机号码
     * @param $mobile
     * @return bool
     */
    protected function isIphone($mobile)
    {
        if (preg_match('/^[1]([3-9])[0-9]{9}$/', $mobile)) return true;
        return false;
    }

    /**
     * 严谨验证手机号码
     * @param $mobile
     * @return bool
     */
    protected function isIphoneAll($mobile)
    {
        if (preg_match('/^[1](([3][0-9])|([4][5-9])|([5][0-3,5-9])|([6][5,6])|([7][0-8])|([8][0-9])|([9][1,8,9]))[0-9]{8}$/', $mobile)) return true;
        return false;
    }

    /**
     * 验证电话号码
     * @param $tel
     * @return bool
     */
    protected function isTel($tel)
    {
        if (preg_match("/^(\(\d{3,4}\)|\d{3,4}-)?\d{7,8}$/", $tel)) return true;
        return false;
    }

    /**
     * 验证身份证号（15位或18位数字）
     * @param int $id 身份证号码
     * @return bool
     */
    protected function isIdCard($id)
    {
        if (preg_match("/^\d{15}|\d{18}$/", $id)) return true;
        return false;
    }

    /**
     * 验证是否是数字(这里小数点会认为是字符)
     * @param $digit
     * @return bool
     */
    protected function isDigit($digit)
    {
        if (preg_match("/^\d*$/", $digit)) return true;
        return false;
    }

    /**
     * 验证是否是数字(可带小数点的数字)
     * @param $num
     * @return bool
     */
    protected function isNum($num)
    {
        if (is_numeric($num)) return true;
        return false;
    }

    /**
     * 验证由数字、26个英文字母或者下划线组成的字符串
     * @param $str
     * @return bool
     */
    protected function isStr($str)
    {
        if (preg_match("/^\w+$/", $str)) return true;
        return false;
    }

    /**
     * 验证用户密码(以字母开头，长度在6-18之间，只能包含字符、数字和下划线)
     * @param $str
     * @return bool
     */
    protected function isPassword($str)
    {
        if (preg_match("/^[a-zA-Z]\w{5,17}$/", $str)) return true;
        return false;
    }

    /**
     * 验证汉字
     * @param $str
     * @return bool
     */
    protected function isChinese($str)
    {
        if (preg_match("/^[\u4e00-\u9fa5],{0,}$/", $str)) return true;
        return false;
    }

    /**
     * 验证Email地址
     * @param $email
     * @return bool
     */
    protected function isEmail($email)
    {
        if (preg_match("/^\w+[-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $email)) return true;
        return false;
    }

    /**
     * 验证网址URL
     * @param $url
     * @return bool
     */
    protected function isLink($url)
    {
        if (preg_match("/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is", $url)) return true;
        return false;
    }

    /**
     * 腾讯QQ号
     * @param $qq
     * @return bool
     */
    protected function isQq($qq)
    {
        if (preg_match("/^[1-9][0-9]{4,}$/", $qq)) return true;
        return false;
    }

    /**
     * 验证IP地址
     * @param $ip
     * @return bool
     */
    protected function isIp($ip)
    {
        if (preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ip)) return true;
        return false;
    }
}
