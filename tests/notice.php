<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

try {
    var_dump((new \DtApp\Notice\Client([
        'webhook' => 'https://oapi.dingtalk.com/robot/send?access_token='
    ]))->dingDingText('111'));
} catch (\DtApp\Tool\DtAppException $e) {
    var_dump($e->errorMessage());
}

try {
    var_dump((new \DtApp\Notice\Client([
        'webhook' => 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key='
    ]))->qyWxText('111'));
} catch (\DtApp\Tool\DtAppException $e) {
    var_dump($e->errorMessage());
}

