<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

var_dump((new \DtApp\Notice\Client([
    'webhook' => 'https://oapi.dingtalk.com/robot/send?access_token='
]))->dingDingText('111'));
