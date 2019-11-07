<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 22:40
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\Notice;

/**
 * 通知中间
 * Class Base
 * @package DtApp\Notice
 */
class Base
{
    /**
     * sendcloud网址
     * @var type
     */
    protected $sendcloud_url = 'https://api.sendcloud.net/apiv2/mail/sendtemplate';

    /**
     * 发送数据
     * @param string $url 网址
     * @param array $data
     * @return bool|string
     */
    public function post_http(string $url, array $data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
