<?php
/**
 * (c) Chaim <gc@dtapp.net>
 */

use DtApp\Pay\WeChat\WeChatMiniClient;
use DtApp\Pay\WeChat\WeChatV2MicroClient;

require_once '../vendor/autoload.php';

//var_dump(convertpubkey("MIID8zCCAtugAwIBAgIUGXNdm3KRpzTiR0dBCrhmYWqEybcwDQYJKoZIhvcNAQEL
//BQAwXjELMAkGA1UEBhMCQ04xEzARBgNVBAoTClRlbnBheS5jb20xHTAbBgNVBAsT
//FFRlbnBheS5jb20gQ0EgQ2VudGVyMRswGQYDVQQDExJUZW5wYXkuY29tIFJvb3Qg
//Q0EwHhcNMTkxMjE3MDcwOTU0WhcNMjQxMjE1MDcwOTU0WjCBhDETMBEGA1UEAwwK
//MTU2NzAyMzE1MTEbMBkGA1UECgwS5b6u5L+h5ZWG5oi357O757ufMTAwLgYDVQQL
//DCfmt7HlnLPniLHlsJrnvZHmtqbmmbrnp5HmioDmnInpmZDlhazlj7gxCzAJBgNV
//BAYMAkNOMREwDwYDVQQHDAhTaGVuWmhlbjCCASIwDQYJKoZIhvcNAQEBBQADggEP
//ADCCAQoCggEBANRUsF0z2CX5bXTYdXF8QHx/rA/bpmB9kQapQWHmf+StEUHpaLpP
//KAhxo+AfGPTcjBHSLcHekxP4oUBFIrHah8YKMoBZaJI3hLVOaFCh+tIfn3CCk3RL
//MREpD1vEc3ERK62wIDjBEGigE0YkvyQ64M2Og4t/UTo33WDSRSf1zRNEI4lbJUn8
//VM1rGoAFc08wH2HYFk9lCGGday2zOMAgi1Bsc8QzODcCgmemauNaXicPDSHX0w/7
//0zRaBEYwxJ4XcriX2rtCHj+ouYz64pft8G8NW2EArvNCUv43cqBOnZ0hb1T061VH
//1ghGJ+Br8r6CttR+TU6Gf+c15JeSAh/xnGECAwEAAaOBgTB/MAkGA1UdEwQCMAAw
//CwYDVR0PBAQDAgTwMGUGA1UdHwReMFwwWqBYoFaGVGh0dHA6Ly9ldmNhLml0cnVz
//LmNvbS5jbi9wdWJsaWMvaXRydXNjcmw/Q0E9MUJENDIyMEU1MERCQzA0QjA2QUQz
//OTc1NDk4NDZDMDFDM0U4RUJEMjANBgkqhkiG9w0BAQsFAAOCAQEAiS+YqbtNySbh
//x8XjXRuMgdZbRQl9WolS8wloWkZ8J0OS9UFshmDYW0H3it0yXeNxacfOYN54HIo2
//shV4vBotC4Dt3rmkhXKBj8Q20POKJ5XCIsaVEaIksiLclWOnsScaopi0uBc0rpw2
//+p8wWHjHlM/JPE2qMoCyflyK1VSppb4HYxLx83nABh3l778j1KSi0mEfI839k0pb
//k2girspGBHmfWMy/B1/PRpEvBPh3HJIx1c6p3rUbMdDVT2R/SEvhRdFcIwwmowph
//q759PzbK9WnX3RfZ/U0L50ddBgWNbFeRZ2M3oSEd8FMQ11HQVbZWqeIKkdifSJe/
//Bk9k/yViIw==")
//);


var_dump(convertprikey("MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDUVLBdM9gl+W10
2HVxfEB8f6wP26ZgfZEGqUFh5n/krRFB6Wi6TygIcaPgHxj03IwR0i3B3pMT+KFA
RSKx2ofGCjKAWWiSN4S1TmhQofrSH59wgpN0SzERKQ9bxHNxESutsCA4wRBooBNG
JL8kOuDNjoOLf1E6N91g0kUn9c0TRCOJWyVJ/FTNaxqABXNPMB9h2BZPZQhhnWst
szjAIItQbHPEMzg3AoJnpmrjWl4nDw0h19MP+9M0WgRGMMSeF3K4l9q7Qh4/qLmM
+uKX7fBvDVthAK7zQlL+N3KgTp2dIW9U9OtVR9YIRifga/K+grbUfk1Ohn/nNeSX
kgIf8ZxhAgMBAAECggEAYmXY0WhsO7Tqj6KcUno1XDzCXRr6cG7gXYjkXt012aCG
hdgIC4cRU1BulDd1Fkx6sOuI/vYJjNDE0Yb4fBl8oD8rhiVo+5G081yhpPRbyzKS
bc5lTRhnZb90eZ+BrB0786LSW9rEoufD5tayqbSLZ1crCON4nhUzh2IKYGldnxY1
hhr73iNfc8emLGvrBaFNM+bEbcLhG/Az0ab84O79MeI4BZ5j4Z367WVErncnx6xe
uBwlIAKSWYohWnweJNwdsUXHm5DMjz2EIwj0GC2f6IuTIZo2/EUNA5ZrOj6d7lnX
WFSjTxTUStCeCPwQd0fn77q6N0wMoefZZCoQ9TvvvQKBgQDu5wG9QSUuBjxZ+0Zh
OMsmSKmROO5XvZXUq13L74Npmkpnn2xDdpROeQvwGn6rsasJOL6HNT+reIyM/F1c
Z6C7KKr6tKtkc5euxZVIvT7/zrd8vrWFxQYsVcF48tyqLzE3s7Xu/VuZJzf8mSLL
JlM5qJXCd0ZjXZCjdVSWBAzk8wKBgQDjhtuRlJwRJdCxMaBVneOuOrz6KdTCgOcp
yrlwsWS/luZT/p+loLI0RkOtGaCMT1cqgNlTcHapqKF73l4lCHbHohpVjuAXb4O1
VBpcn8qpmfEtrjWcc+sAcY76QOettnKETKkEsMxJ1EcRE2U6aepCTCCQBB3DdZsC
tTBbLkleWwKBgQCed/1fXGcdMGW4CkWVF+cpbemMuwbejJNmjoWZUTcKRZ41PjrC
RVX697BDhE+h9ChP5aP8bAXf6AbTPlNviA3GGCPSSSWnbEWhWM69gUrYxHZR+O7P
3PFLV1cOs4pMGSG8oSh9bvHjlXA9zhaWSsXJ6VnttNCr+NSImLuTBvzGoQKBgQCU
0pn+AFmQ8c4uiMpaFhtd1DfV3dS3oL8TW/Gt36qJkvd3S147ZQALJ0aPC+syu5bF
S2Bbrn0/ffiaYBnuWTnwXHyjKAA19BAPZEKWAUL7aqERgxi4DC5TrPObhybDPkpr
dQU89zO4uuv9JFWbPromwUqvSLH7LorE26UUjxMYbwKBgQDgjHaM3wjcjNZlgRj7
NOlYh/T/z8R5o6ZVK61vqCMs1wY///5YkNzKhYgBgO2Z6zRazontETtPJez4kjAR
D3URfnRduFwtTDVkpX0QGuQ4LGUH3A/464FANZWOdPDw+rkXf/KsLAeeOdMIIXgc
WiDDjXk/4WJqqoxwdwaQh+SiPA=="));

function convertpubkey($keyvalue)
{
    $start_key = str_replace('-----BEGIN PUBLIC KEY-----', '', $keyvalue);
    $start_key = trim(str_replace('-----END PUBLIC KEY-----', '', $start_key));
    $public_content = wordwrap($start_key, 64, "\n", true);
    $key = <<<EOF
-----BEGIN PUBLIC KEY-----
{$public_content}
-----END PUBLIC KEY-----
EOF;
    return $key;
}

function convertprikey($keyvalue)
{
    $start_key = str_replace('-----BEGIN RSA PRIVATE KEY-----', '', $keyvalue);
    $start_key = trim(str_replace('-----END RSA PRIVATE KEY-----', '', $start_key));
    //wordwrap 按照指定的长度，对字符串进行换行
    $private_content = wordwrap($start_key, 64, "\n", true);
    $key = <<<EOF
-----BEGIN RSA PRIVATE KEY-----
{$private_content}
-----END RSA PRIVATE KEY-----
EOF;
    return $key;
}
