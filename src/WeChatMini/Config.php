<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/6
 * Time: 16:25
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\WeChatMini;

/**
 * 微信小程序配置
 * Class Config
 * @package liguangchun\WeMini
 */
class Config
{
    protected $appid = '';
    protected $secret = '';
    protected $tokenFile = '';

    public function __construct(array $config = [])
    {
        if (!empty($config['appid'])) $this->appid = $config['appid'];
        if (!empty($config['secret'])) $this->secret = $config['secret'];
        if (!empty($config['tokenfile'])) $this->tokenFile = $config['tokenfile'];
    }

    protected function get_http($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output, true);
    }
}
