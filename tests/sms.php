<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

\DtApp\Sms\SmsBaoClient::setConfig([
    'user' => '',
    'pass' => ''

]);
// 查询额度
var_dump(\DtApp\Sms\SmsBaoClient::queryBalance());
