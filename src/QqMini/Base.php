<?php
/**
 * Created by : PhpStorm
 * Date: 2019/11/8
 * Time: 0:28
 * User: 李光春 gc@dtapp.net
 */

namespace DtApp\QqMini;

/**
 * QQ小程序
 * Class Base
 * @package DtApp\QqMini
 */
class Base
{
    /**
     * Get请求
     * @param $url
     * @param null $data
     * @return mixed
     */
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
