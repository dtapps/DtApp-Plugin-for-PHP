<?php
/**
 * PHP常用函数
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

$tool = new \DtApp\Tool\Tool();

// 编码
var_dump($tool->urlLenCode('https://www.liguangchun.cn/'));
// 解码
var_dump($tool->urlDeCode('https%3A%2F%2Fwww.liguangchun.cn%2F'));
// 随机
var_dump($tool->randomPN(2));

var_dump($tool->pregIsIphoneAll('13553695467'));
