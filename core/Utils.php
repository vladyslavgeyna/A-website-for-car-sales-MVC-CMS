<?php

namespace core;

class Utils
{
    private static string $UrlExchangeRateApi = "https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11";


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

    private static function curl_get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }


    public static function getCurrentUSDToUAH(): float
    {
        $stringContent = self::curl_get_contents(self::$UrlExchangeRateApi);
        $stringJSON = json_decode($stringContent, true);
        return floatval($stringJSON[1]["buy"]);

    }

    public static function getCurrentEURToUAH(): float
    {
        $stringContent = self::curl_get_contents(self::$UrlExchangeRateApi);
        $stringJSON = json_decode($stringContent, true);
        return floatval($stringJSON[0]["buy"]);
    }

    public static function getCurrentEURToUSD()
    {
        return self::getCurrentEURToUAH() / self::getCurrentUSDToUAH();
    }

    public static function isStringContains($string, $needle): bool
    {
        if (strpos($string, $needle) !== false)
        {
            return true;
        }
        return false;
    }

    public static function debug($object)
    {
        echo "<pre>";
        var_dump($object);
        echo "</pre>";
        die();
    }

}