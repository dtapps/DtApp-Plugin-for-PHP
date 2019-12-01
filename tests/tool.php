<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/28
 * Time: 13:49
 * User: Chaim gc@dtapp.net
 */

require_once '../vendor/autoload.php';

$tool = new \DtApp\Tool\Tool();

// 编码
var_dump($tool->urlLenCode('https://www.liguangchun.cn/'));
// 解码
var_dump($tool->urlDeCode('https%3A%2F%2Fwww.liguangchun.cn%2F'));
// 当前IP地址
var_dump($tool->ipGet());

var_dump($tool->reqIsEmptyRet(['id'=>'1111'],['id','user']));
