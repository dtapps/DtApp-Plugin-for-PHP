<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';


// 编码
var_dump(\DtApp\Tool\Tool::urlLenCode('https://www.liguangchun.cn/'));
// 解码
var_dump(\DtApp\Tool\Tool::urlDeCode('https%3A%2F%2Fwww.liguangchun.cn%2F'));
// 随机
var_dump(\DtApp\Tool\Tool::randomPN(2));

var_dump(\DtApp\Tool\Tool::timeGetUDate());

var_dump(\DtApp\Tool\Tool::strExtractBefore('52722', 0, 1));

var_dump(\DtApp\Tool\Tool::timeCheckIsBetweenTime('00:00', '23:59'));
