<?php

namespace models;

use core\Core;

class Carad
{
    protected static string $tableName = "car_ad";

    public static function addCarAd($car_id, $title, $text, $date_of_creating, $user_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "car_id" => $car_id,
            "title" => $title,
            "text" => $text,
            "date_of_creating" => $date_of_creating,
            "user_id" => $user_id
        ]);
    }

    public static function getAllCarAds(): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName);
        if(!empty($car_ads))
        {
            return $car_ads;
        }
        return null;
    }

    public static function getCarAdByCarId($car_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if(!empty($car_ad))
        {
            return $car_ad[0];
        }
        return null;
    }

    public static function getCarAdByCarIdInnered($car_id)
    {
        $car_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_id" => $car_id
        ]);
        if(!empty($car_ad))
        {
            $result = $car_ad[0];
            $result["car"] = Car::getCarByIdInnered($car_ad[0]["car_id"]);
            return $result;
        }
        return null;
    }

    public static function getAllCarAdsInnered(): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName);
        if(!empty($car_ads))
        {
            $result = $car_ads;
            for ($i = 0; $i < count($car_ads); $i++)
            {
                $result[$i]["car"] = Car::getCarByIdInnered($car_ads[$i]["car_id"]);
            }
            return $result;
        }
        return null;
    }

    public static function getCountOfCarAdsByUserId($user_id): ?int
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id
        ]);
        if(!empty($car_ads))
        {
            return count($car_ads);
        }
        return null;
    }

    public static function getAllCarAdsByUserIdInnered($user_id): ?array
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id
        ]);
        if(!empty($car_ads))
        {
            $result = $car_ads;
            for ($i = 0; $i < count($car_ads); $i++)
            {
                $result[$i]["car"] = Car::getCarByIdInnered($car_ads[$i]["car_id"]);
            }
            return $result;
        }
        return null;
    }

    public static function getAllActiveCarAdsInnered(): ?array
    {
        $active_car_ads = Core::getInstance()->db->select(self::$tableName, "*",  [
            "is_active" => 1
        ]);
        if(!empty($active_car_ads))
        {
            $result = $active_car_ads;
            for ($i = 0; $i < count($active_car_ads); $i++)
            {
                $result[$i]["car"] = Car::getCarByIdInnered($active_car_ads[$i]["car_id"]);
            }
            return $result;
        }
        return null;
    }

    public static function getCountOfCarAds(): int
    {
        $car_ads = Core::getInstance()->db->select(self::$tableName);
        return count($car_ads);
    }


}