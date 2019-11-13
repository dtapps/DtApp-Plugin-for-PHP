<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/10
 * Time: 18:51
 * User: 李光春 gc@dtapp.net
 */

require_once './vendor/autoload.php';

$aes = new \DtApp\Aes\MiniProgram('7324564123765898', '1678457982365432');
var_dump($aes);
// 加密 自动识别是array还是字符串
var_dump($aes->encrypt('1111'));
// 解密
var_dump($aes->decrypt('1AJUtKsCiKzz6m252xXnAryLPzMnF%2BXrl4jW8BvKb%2FM3S4aQd6d%2BdtThi56E7g7t'));
