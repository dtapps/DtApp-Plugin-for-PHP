<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

require_once '../vendor/autoload.php';

\DtApp\Pay\WeChat\WeChatV2MicroClient::setConfig([
    'mchId' => 'xxx',
    'apiKey' => 'xxx',
    'apiV3Key' => 'xxx',
    'serialNo' => 'xxx',
    'publicKey' => __DIR__ . '/apiclient_cert.pem',
    'privateKey' => __DIR__ . '/apiclient_key.pem'
]);


//var_dump(\DtApp\Pay\WeChat\WeChatMicroClient::meNtCreate([
//    'id_card_copy' => '1',
//    'id_card_national' => '1',
//    'id_card_name' => '1',
//    'id_card_number' => '1',
//    'id_card_valid_time' => '1',
//    'account_name' => '1',
//    'account_bank' => '1',
//    'bank_address_code' => '1',
//    'account_number' => '1',
//    'store_name' => '1',
//    'store_address_code' => '1',
//    'store_street' => '1',
//    'store_entrance_pic' => '1',
//    'indoor_pic' => '1',
//    'address_certification' => '1',
//    'merchant_shortname' => '1',
//    'service_phone' => '1',
//    'product_desc' => '餐饮',
//    'rate' => '1',
//    'contact' => '1',
//    'contact_phone' => '1',
//    'contact_email' => '1'
//]));


var_dump(\DtApp\Pay\WeChat\WeChatV2MicroClient::updateImg(__DIR__ . '/5df9d42289350.jpg'));
