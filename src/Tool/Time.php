<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * 时间
 * Class Time
 * @package DtApp\Tool
 */
class Time extends Base
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Shanghai');
    }

    /**
     * 当前时间
     * @param string $format 格式
     * @return false|string
     */
    protected function getData(string $format)
    {
        date_default_timezone_set('Asia/Shanghai');
        return date($format, time());
    }

    /**
     * 当前时间戳
     * @return false|string
     */
    protected function getTime()
    {
        date_default_timezone_set('Asia/Shanghai');
        return time();
    }

    /**
     * 毫秒时间
     * @param string $format 格式 默认：YmdHisu
     * @return false|string
     */
    protected function getUDate(string $format)
    {
        date_default_timezone_set('Asia/Shanghai');
        if (is_null(null)) {
            $utimestamp = microtime(true);
        }
        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);//改这里的数值控制毫秒位数
        return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
    }

    /**
     *  计算两个时间差
     * @param string $end_time 结束时间
     * @param string $start_time 开始时间
     * @return false|int
     */
    protected function getTimeDifference(string $end_time, string $start_time)
    {
        $end_time = strtotime($end_time);
        $start_time = $start_time == '' ? strtotime(self::getData()) : strtotime($start_time);
        return $end_time - $start_time;
    }

    /**
     * 将指定日期转换为时间戳
     * @param $date
     * @return false|int
     */
    protected function dateToTimestamp($date)
    {
        return strtotime($date);
    }
}
