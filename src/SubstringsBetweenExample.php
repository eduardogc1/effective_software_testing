<?php

namespace App;

class SubstringsBetweenExample
{    
    /**
     * substringsBetween
     *
     * @param string $str
     * @param string $open
     * @param string $close
     * @return string[]
     */
    public static function substringsBetween(
        string $str,
        string $open,
        string $close
    ): array|null {

        if ($str == null || empty($open) || empty($close)) {
            return null;
        }

        $strLen = strlen($str);
        if ($strLen == 0) {
            return [];
        }

        $closeLen = strlen($close);
        $openLen = strlen($open);
        $list = [];

        $pos = 0;
        while ($pos < $strLen - $closeLen) {
            $start = strpos($str, $open, $pos);

            if ($start === false) {
                break;
            }
            $start += $openLen;
            $end = strpos($str, $close, $start);
            if ($end === false) {
                break;
            }

            $list[] = substr($str, $start, $end - $start);
            $pos = $end + $closeLen;
        }

        if (empty($list)) {
            return null;
        }

        return $list;
    }
}
