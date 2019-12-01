<?php
/**
 * Name:LiGuAngChun
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';


var_dump((new \DtApp\Notice\Client([
    'webhook' => 'https://oapi.dingtalk.com/robot/send?access_token=aad81de7f6b218bb7d085264d4885714c805cc80a460690a0d19db91a05dd174'
]))->dingDingText('111'));
