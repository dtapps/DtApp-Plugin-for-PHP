<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */


namespace DtApp\Notice\SendCloud;


use DtApp\Notice\SendCloudClient;

class Base extends SendCloudClient
{
    /**
     * sendCloud网址
     * @var string
     */
    private static $sendcloud_url = 'https://api.sendcloud.net/apiv2/mail/sendtemplate';


    /**
     * 发送邮箱
     * @param $apiUser
     * @param $apiKey
     * @param $form
     * @param $from_name
     * @param $template
     * @param string $email 收件人地址
     * @param string $title 邮箱标题
     * @param string $desc 邮箱描述
     * @param array $content 邮箱内容
     * @return bool
     */
    protected static function send($apiUser, $apiKey, $form, $from_name, $template, string $email, string $title, string $desc, array $content)
    {
        $result = json_decode(self::send_mail($apiUser, $apiKey, $form, $from_name, $template, $email, $title, $content, $desc), true);
        if ($result['result'] == true) return true;
        return false;
    }

    /**
     * 发送请求
     * @param $apiUser
     * @param $apiKey
     * @param $form
     * @param $from_name
     * @param $template
     * @param string $to 地址列表
     * @param string $subject 邮件标题
     * @param string $xsmtpapi SMTP 扩展字段
     * @param string $content_summary 邮件摘要
     * @return false|string
     */
    private static function send_mail($apiUser, $apiKey, $form, $from_name, $template, string $to, string $subject, string $xsmtpapi, string $content_summary)
    {
        $data = http_build_query([
            'apiUser' => $apiUser,
            'apiKey' => $apiKey,
            'from' => $form,
            'fromName' => $from_name,
            'to' => $to,
            'subject' => $subject,
            'templateInvokeName' => $template,
            'contentSummary' => $content_summary,
            'xsmtpapi' => json_encode([
                'to' => [$to],
                'sub' => $xsmtpapi
            ])
        ]);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data
            ));
        $context = stream_context_create($options);
        return file_get_contents(self::$sendcloud_url, false, $context);
    }
}
