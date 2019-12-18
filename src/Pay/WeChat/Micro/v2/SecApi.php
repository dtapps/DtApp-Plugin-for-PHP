<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Pay\WeChat\Micro\v2;

class SecApi extends Base
{
    private static $upload_media_url_v3 = 'https://api.mch.weixin.qq.com/v3/merchant/media/upload';

    /**
     * 图片上传API
     * https://pay.weixin.qq.com/wiki/doc/apiv3/wxpay/tool/chapter3_1.shtml
     * @param string $mch_id
     * @param string $file
     * @param string $serial_no
     * @param string $private_key
     * @return string
     */
    protected static function uploadMedia(string $mch_id, string $file, string $serial_no, string $private_key)
    {
        $imginfo = pathinfo($file);
        $api = self::$upload_media_url_v3;
        $boundary = '7derenufded';//分割符号
        $PSize = filesize($file);
        $picturedata = fread(fopen($file, "r"), $PSize);
        $sign = hash('sha256', $picturedata);
        $strdata = [
            'filename' => $imginfo['basename'],
            'sha256' => $sign,
        ];
        $boundarystr = "--{$boundary}\r\n";

        // $out是post的内容

        $out = $boundarystr;
        $out .= 'Content-Disposition: form-data; name="meta"' . "\r\n";
        $out .= 'Content-Type: application/json; charset=UTF-8' . "\r\n";
        $out .= "\r\n";
        $filestr = json_encode($strdata);
        $out .= "" . $filestr . "\r\n";
        $out .= $boundarystr;
        $out .= 'Content-Disposition: form-data; name="file"; filename="' . $imginfo['basename'] . '"' . "\n";
        $out .= 'Content-Type: image/' . $imginfo['extension'] . ';' . "\r\n";
        $out .= "\r\n";
        $out .= $picturedata . "\r\n";
        $out .= "--{$boundary}--\r\n";


        // -----  下面是签名过程 -----------

        $url = $api;
        $method = 'POST';
        $http_method = $method;
        $timestamp = time();
        $nonce = self::getNonceStr();
        $mch_private_key = file_get_contents($private_key);
        $merchant_id = $mch_id;
        $serial_no = $serial_no;

        $url_parts = parse_url($url);
        $canonical_url = ($url_parts['path'] . (!empty($url_parts['query']) ? "?${url_parts['query']}" : ""));
        $message = $http_method . "\n" .
            $canonical_url . "\n" .
            $timestamp . "\n" .
            $nonce . "\n" .
            $filestr .
            "\n";
        openssl_sign($message, $raw_sign, $mch_private_key, 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);
        $schema = 'WECHATPAY2-SHA256-RSA2048';
        $token = sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
            $merchant_id, $nonce, $timestamp, $serial_no, $sign);

        // ----- 是请求头部--------

        $header = [
            'Authorization: ' . $schema . ' ' . $token,
            'Accept: application/json',
            "Content-Type: multipart/form-data;boundary=" . $boundary,
            'User-Agent: XXXXXXXXX',
        ];

        // 最后带上头部和POST内容 发送CURL请求吧。
        $content = $out;
        $ch = curl_init();
        if (substr($url, 0, 5) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $response = curl_exec($ch);
        if ($error = curl_error($ch)) {
            die($error);
        }
        curl_close($ch);
        try {
            return json_decode($response, true);
        } catch (\Exception $e) {
            return false;
        }
    }
}
