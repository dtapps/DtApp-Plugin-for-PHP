<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/19
 * Time: 11:45
 * User: Chaim gc@dtapp.net
 */

namespace DtApp\MyRedis;

use Redis;

/**
 * Redis
 * Class MyRedis
 * @package DtApp\MyRedis
 */
class MyRedis
{
    private static $handler;

    private static function handler()
    {
        if (!self::$handler) {
            self::$handler = new Redis();
            self::$handler->connect('127.0.0.1', '6379');
        }
        return self::$handler;
    }

    public static function get($key)
    {
        $value = self::handler()->get($key);
        $value_serl = @unserialize($value);
        if (is_object($value_serl) || is_array($value_serl)) return $value_serl;
        return $value;
    }

    public static function set($key, $value)
    {
        if (is_object($value) || is_array($value)) $value = serialize($value);
        return self::handler()->set($key, $value);
    }
}
