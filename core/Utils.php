<?php

namespace core;

class Utils
{
    private static string $UrlExchangeRateApi = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json";

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

    public static function isIntDigit($value): bool
    {
        return !(false !== strpos($value, '.')) && is_numeric($value);
    }

    public static function hasTheSameIdAsInArray($array, $id): bool
    {
        if (!empty($array))
        {
            $allId = [];
            foreach ($array as $item)
            {
                $allId []= $item["id"];
            }
            if(in_array($id, $allId))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public static function getCurrentUSDToUAH()
    {
        $stringContent = file_get_contents(self::$UrlExchangeRateApi);
        $stringJSON = json_decode($stringContent, true);
        return floatval($stringJSON[25]["rate"]);

    }

    public static function getCurrentEURToUAH()
    {
        $stringContent = file_get_contents(self::$UrlExchangeRateApi);
        $stringJSON = json_decode($stringContent, true);
        return floatval($stringJSON[32]["rate"]);
    }

    public static function getCurrentEURToUSD()
    {
        return self::getCurrentEURToUAH() / self::getCurrentUSDToUAH();
    }


}