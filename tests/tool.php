<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

use DtApp\Tool\Tool;

require_once '../vendor/autoload.php';


//// 编码
//var_dump(Tool::urlLenCode('https://www.liguangchun.cn/'));
// 解码
var_dump(Tool::urlDeCode('https%3A%2F%2Fwww.liguangchun.cn%2F'));
// 随机
var_dump(Tool::randomPN(2));
// 毫秒时间
var_dump(Tool::timeGetUDate());
// 截取字符串前面n个字符
var_dump(Tool::strExtractBefore('52722', 0, 1));
// 判断当前的时分是否在指定的时间段内
var_dump(Tool::timeCheckIsBetweenTime('00:00', '23:59'));
// 判断字符串是否包含某个字符
var_dump(Tool::strExitContain('55,444', '3', ','));
