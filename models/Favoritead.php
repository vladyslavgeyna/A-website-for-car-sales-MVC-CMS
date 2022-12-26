<?php

namespace models;

use core\Core;

class Favoritead
{
    protected static string $tableName = "favorite_ad";

    public static function hasCurrentUserFavoriteAdByCarAdId($car_ad_id): ?bool
    {
        if (User::isUserAuthenticated())
        {
            $user_id = User::getCurrentUserId();
            $favorite_ad = Core::getInstance()->db->select(self::$tableName, "*", [
                "car_ad_id" =>  $car_ad_id,
                "user_id" => $user_id
            ]);
            return !empty($favorite_ad);
        }
        else
        {
            return null;
        }
    }

    public static function getCountOfFavoriteAdByCarAdId($car_ad_id): int
    {
        return Core::getInstance()->db->count(self::$tableName, [
            "car_ad_id" => $car_ad_id
        ]);
    }

    public static function addFavoriteAd($user_id, $car_ad_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            "user_id" => $user_id,
            "car_ad_id" => $car_ad_id
        ]);
    }

    public static function deleteFavoriteAdByUserIdAndCarAdId($user_id, $car_ad_id)
    {
        $fav_ad = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id,
            "car_ad_id" => $car_ad_id
        ]);
        if (!empty($fav_ad))
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

    public static function deleteAllFavoriteAdsByCarAdId($car_ad_id)
    {
        $fav_ads = self::getAllFavoriteAdsByCarAdId($car_ad_id);
        if (!empty($fav_ads))
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

    public static function getAllFavoriteAdsByCarAdId($car_ad_id): ?array
    {
        $fav_ads = Core::getInstance()->db->select(self::$tableName, "*", [
            "car_ad_id" => $car_ad_id
        ]);
        if (!empty($fav_ads))
        {
            return $fav_ads;
        }
        else
        {
            return null;
        }
    }

    public static function getCountOfFavoriteAdByUserId($user_id)
    {
        return Core::getInstance()->db->count(self::$tableName, [
            "user_id" => $user_id
        ]);
    }

    public static function getAllFavoriteAdsByUserIdInnered($user_id): ?array
    {
        $fav_ads = Core::getInstance()->db->select(self::$tableName, "*", [
            "user_id" => $user_id
        ]);
        if(!empty($fav_ads))
        {
            $result = [];
            for ($i = 0; $i < count($fav_ads); $i++)
            {
                $tmp_car_ad = Carad::getActiveCarAdById($fav_ads[$i]["car_ad_id"]);
                if (!empty($tmp_car_ad))
                {
                    $result []= $tmp_car_ad;
                    $result[$i]["car"] = Car::getCarByIdInnered($result[$i]["car_id"]);
                    $result[$i]["user"] = User::getUserByIdInnered($result[$i]["user_id"]);
                }
            }
            return $result;
        }
        return null;
    }




}