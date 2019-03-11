<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 22.01.2019
 * Time: 11:05
 */

namespace App\Helpers;


class ArrayHelpers
{
    public static function cleanArrayFromEmptyElements($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $sub_array) {
                $result = self::cleanArrayFromEmptyElements($sub_array);
                if ($result === false) {
                    unset($array[$key]);
                } else {
                    $array[$key] = $result;
                }
            }
        }

        if (empty($array) and $array != 0) {
            return false;
        }

        return $array;
    }

    public static function dropArrayIfOnlyOneElement($array)
    {

        if (is_array($array)) {
            foreach ($array as $key => $sub_array) {
                $result = self::dropArrayIfOnlyOneElement($sub_array);
                $array[$key] = $result;
            }
        }

        if (is_array($array) and count($array) === 1 and !is_array(array_values($array)[0])) {
            return array_values($array)[0];
        }

        return $array;

    }


}