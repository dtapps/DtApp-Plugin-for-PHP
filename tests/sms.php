<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

$smsBao = new \DtApp\Sms\SmsBaoClient([
    'user' => '',
    'pass' => ''
]);
// 查询额度
var_dump($smsBao->queryBalance());
