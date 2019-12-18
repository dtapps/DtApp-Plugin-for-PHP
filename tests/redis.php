<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

try {
    \DtApp\DataBase\RedisClient::setConfig([
        'prefix' => 'pp_'
    ]);
    var_dump(\DtApp\DataBase\RedisClient::set('chaim_test', '111', 11111));
    var_dump(\DtApp\DataBase\RedisClient::get('chaim_test'));
    var_dump(\DtApp\DataBase\RedisClient::del('chaim_test'));
} catch (\DtApp\Tool\DtAppException $e) {
    var_dump($e->errorMessage());
}
