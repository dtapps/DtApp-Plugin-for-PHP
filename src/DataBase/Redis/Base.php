<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\DataBase\Redis;

use DtApp\DataBase\RedisClient;
use DtApp\Tool\DtAppException;
use Exception;
use Redis;

/**
 * Redis
 * Class Base
 * @package DtApp\DataBase\Redis
 */
class Base extends RedisClient
{
    /**
     * @param string $db
     * @param string $ip
     * @param int $port
     * @return Redis
     * @throws DtAppException
     */
    protected static function connection($db = "0", $ip = "127.0.0.1", $port = 6379)
    {
        try {
            $redis = new Redis();
        } catch (Exception $e) {
            throw new DtAppException('php.ini缺少php_redis.dll文件配置');
        }
        try {
            $redis->connect($ip, $port);
        } catch (Exception $e) {
            throw new DtAppException("连接redis服务器失败,请检查redis服务器是否开启");
        }
        $redis->select($db);
        return $redis;
    }
}

