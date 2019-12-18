<?php
/**
 * PHP常用函数
 * https://git.dtapp.net/Chaim/DtApp-Plugin-for-PHP.git
 * (c) Chaim <gc@dtapp.net>
 */

namespace DtApp\Tool;

/**
 * Class Xml
 * @package DtApp\Tool
 */
class Xml extends Tool
{
    /**
     * 数组转换为xml
     * @param array $values 数组
     * @return string
     * @throws DtAppException
     */
    protected static function toXml(array $values)
    {
        if (!is_array($values) || count($values) <= 0) throw new DtAppException('数组数据异常！');
        $xml = "<xml>";
        foreach ($values as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * 将XML转为array
     * @param string $xml
     * @return mixed
     * @throws DtAppException
     */
    protected static function toArray(string $xml)
    {
        if (!$xml) throw new DtAppException('xml数据异常！');
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }
}
