<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\DataBase;


use DtApp\DataBase\Redis\Base;
use DtApp\Tool\DtAppException;

/**
 * Redis缓存数据库
 * Class RedisClient
 * @package DtApp\DataBase
 */
class RedisClient
{
    private static $ip = "127.0.0.1";
    private static $port = 6379;
    private static $db = "0";
    private static $prefix = '';
    private static $expire = 0;

    /**
     * 配置
     * @param array $config
     */
    public static function setConfig($config = [])
    {
        if (!empty($config['ip'])) self::$ip = $config['ip'];
        if (!empty($config['port'])) self::$port = $config['port'];
        if (!empty($config['db'])) self::$db = $config['db'];
        if (!empty($config['prefix'])) self::$prefix = $config['prefix'];
        if (!empty($config['expire'])) self::$expire = $config['expire'];
    }

    /**
     * @param string $key
     * @return bool|mixed|string
     * @throws DtAppException
     */
    public static function get(string $key)
    {
        if (empty($key)) throw new DtAppException('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        return $redis->get($name);
    }

    /**
     * 设置
     * 这里的时间优先于全局
     * @param string $key
     * @param $value
     * @param int $ttl
     * @return bool
     * @throws DtAppException
     */
    public static function set(string $key, $value, $ttl = 0)
    {
        if (empty($key) || empty($value)) throw new DtAppException('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        $redis->set($name, $value);
        if (!empty($ttl) || !empty(self::$expire)) {
            if (!empty($ttl)) {
                $redis->expireAt($name, time() + $ttl);
                return true;
            }
            if (!empty(self::$expire)) {
                $redis->expireAt($name, time() + self::$expire);
                return true;
            }
        }
        return false;
    }

    /**
     * 查看key的存活时间
     * @param string $key
     * @return bool|int
     * @throws DtAppException
     */
    public static function getTtl(string $key)
    {
        if (empty($key)) throw new DtAppException('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        return $redis->ttl($name);
    }

    /**
     * 删除一个key
     * @param string $key
     * @return int
     * @throws DtAppException
     */
    public static function del(string $key)
    {
        if (empty($key)) throw new DtAppException('请检查参数');
        $name = $key;
        if (!empty(self::$prefix)) $name = self::$prefix . $key;
        $redis = Base::connection(self::$db, self::$ip, self::$port);
        $res = $redis->del($name);
        if (!empty($res)) return true;
        return false;
    }
}
