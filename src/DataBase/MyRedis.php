<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/19
 * Time: 11:45
 * User: Chaim gc@dtapp.net
 */

namespace DtApp\DataBase;

/**
 * Redis
 * Class MyRedis
 * @package DtApp\MyRedis
 */
class MyRedis
{
    protected static $handler = null;
    private $host = '127.0.0.1';
    private $port = '6379';
    private $password = '';
    private $select = 0;
    private $timeout = 0;
    private $expire = 0;
    private $persistent = false;
    private $prefix = '';

    public function __construct(array $config = [])
    {
        var_dump(111111111111);
        if (!empty($config['host'])) $this->host = $config['host'];
        if (!empty($config['port'])) $this->port = $config['port'];
        if (!empty($config['password'])) $this->password = $config['password'];
        if (!empty($config['select'])) $this->select = $config['select'];
        if (!empty($config['timeout'])) $this->timeout = $config['timeout'];
        if (!empty($config['expire'])) $this->expire = $config['expire'];
        if (!empty($config['persistent'])) $this->persistent = $config['persistent'];
        if (!extension_loaded('redis')) throw new \BadFunctionCallException('not support: redis');//判断是否有扩展(如果你的apache没reids扩展就会抛出这个异常)
        $func = $this->persistent ? 'pconnect' : 'connect';     //判断是否长连接
        self::$handler = new \Redis();
        self::$handler->$func($this->host, $this->port, $this->timeout);
        if ('' != $this->password) self::$handler->auth($this->password);
        if (0 != $this->select) self::$handler->select($this->select);
    }

    /**
     * 读取缓存
     * @param string $key 键值
     * @return mixed
     */
    public static function get(string $key)
    {
        var_dump($key);
        $fun = is_array($key) ? 'Mget' : 'get';
        return self::$handler->{$fun}($key);
    }

    /**
     * 写入缓存
     * @param string $key 键名
     * @param string $value 键值
     * @param int $exprie 过期时间 0:永不过期
     * @return bool
     */
    public static function set(string $key, string $value, int $exprie = 0)
    {
        if ($exprie == 0) return self::$handler->set($key, $value);
        return self::$handler->setex($key, $exprie, $value);
    }

    /**
     * 获取值长度
     * @param string $key
     * @return bool|int
     */
    public static function lLen(string $key)
    {
        return self::$handler->lLen($key);
    }

    /**
     * 将一个或多个值插入到列表头部
     * @param $key
     * @param $value
     * @param null $value2
     * @param null $valueN
     * @return bool|int
     */
    public static function LPush($key, $value, $value2 = null, $valueN = null)
    {
        return self::$handler->lPush($key, $value, $value2, $valueN);
    }

    /**
     * 移出并获取列表的第一个元素
     * @param string $key
     * @return bool|mixed
     */
    public static function lPop(string $key)
    {
        return self::$handler->lPop($key);
    }
}
