<?php

namespace KofeinStyle\Helper;

/**
 * @author Efimov Maxim
 * @since 1.0
 */
class Dumper
{

    public static function dump($value, $caption = "", $escape = true)
    {

        ob_start();
        if (is_bool($value)) {
            if ($value) {
                $value = 'TRUE';
            } else {
                $value = 'FALSE';
            }
        }
        if (is_null($value)) {
            $value = 'NULL';
        }
        print_r($value);
        $content = ob_get_contents();
        ob_end_clean();
        $callingPlace = self::getCallingPlace() . "\n\n";
        echo "<pre class='dump'>" . htmlspecialchars($callingPlace) . htmlspecialchars($caption) . ' ' . ($escape ? htmlspecialchars($content) : $content) . "</pre>";

    }


    public static function dumpx($value = 'ok')
    {
        self::dump($value);
        die();
    }

    private static function getCallingPlace($returnArray = false)
    {
        if (!$returnArray) {
            $result = "";
        } else {
            $result = array();
        }

        if (function_exists("debug_backtrace")) {
            $backtrace = debug_backtrace();
            if (count($backtrace) > 1) {
                if ($returnArray) {
                    $result = array($backtrace[1]['file'], $backtrace[1]['line']);
                } else {
                    $result = $backtrace[1]['file'] . ":" . $backtrace[1]['line'];
                }
            }
        }

        return $result;
    }

}
