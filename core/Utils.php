<?php

namespace core;

class Utils
{
    public static function filterArray($array, $fieldsList): array
    {
        $filteredArray = [];
        foreach ($array as $key => $value)
        {
            if (in_array($key, $fieldsList))
            {
                $filteredArray[$key] = $value;
            }
        }
        return $filteredArray;
    }

    public static function getHashedString($string): string
    {
        return md5($string);
    }

    public static function getFileExtension($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }
}