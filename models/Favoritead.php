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
        $favorite_ads = Core::getInstance()->db->select(self::$tableName, "*", [
           "car_ad_id" => $car_ad_id
        ]);
        return count($favorite_ads);
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


}