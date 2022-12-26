<?php

namespace models;

use core\Core;

class Carcomparison
{
    protected static string $tableName = "car_comparison";

    public static function hasCurrentUserCarComparisonByCarAdId($car_ad_id): ?bool
    {
        if (User::isUserAuthenticated())
        {
            $user_id = User::getCurrentUserId();
            $car_comparison = Core::getInstance()->db->select(self::$tableName, "*", [
                "car_ad_id" => $car_ad_id,
                "user_id" => $user_id
            ]);
            return !empty($car_comparison);
        }
        else
        {
            return null;
        }
    }

    public static function addCarComparison($user_id, $car_ad_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "user_id" => $user_id,
            "car_ad_id" => $car_ad_id
        ]);
    }

    public static function deleteCarComparisonByUserIdAndCarAdId($user_id, $car_ad_id)
    {
        $car_comp = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id,
            "car_ad_id" => $car_ad_id
        ]);
        if (!empty($car_comp))
        {
            Core::getInstance()->db->delete(self::$tableName, [
                "user_id" => $user_id,
                "car_ad_id" => $car_ad_id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function deleteAllCarComparisonsByCarAdId($car_ad_id)
    {
        $car_comp = self::getAllCarComparisonsByCarAdId($car_ad_id);
        if (!empty($car_comp))
        {
            Core::getInstance()->db->delete(self::$tableName, [
                "car_ad_id" => $car_ad_id
            ]);
        }
        else
        {
            return null;
        }
    }

    public static function getAllCarComparisonsByCarAdId($car_ad_id): ?array
    {
        $car_comp = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_ad_id" => $car_ad_id
        ]);
        if (!empty($car_comp))
        {
            return $car_comp;
        }
        else
        {
            return null;
        }
    }




    public static function getAllCarComparisonsByUserIdInnered($user_id): ?array
    {
        $car_comp = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id
        ]);
        if(!empty($car_comp))
        {
            $result = [];
            for ($i = 0; $i < count($car_comp); $i++)
            {
                $tmp_car_ad = Carad::getActiveCarAdById($car_comp[$i]["car_ad_id"]);
                if (!empty($tmp_car_ad))
                {
                    $result []= $tmp_car_ad;
                    $result[$i]["car"] = Car::getCarByIdInnered($result[$i]["car_id"]);
                  //  $result[$i]["user"] = User::getUserByIdInnered($result[$i]["user_id"]);
                }
            }
            return $result;
        }
        return null;
    }


}